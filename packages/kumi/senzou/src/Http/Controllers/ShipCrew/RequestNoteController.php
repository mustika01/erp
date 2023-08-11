<?php

namespace Kumi\Senzou\Http\Controllers\ShipCrew;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Kumi\Senzou\Models\RequestNote;
use Kumi\Senzou\Models\RequestNoteItem;
use Kumi\Senzou\Support\Enums\RequestNoteDeliveryRequirements;
use Kumi\Senzou\Support\Enums\RequestNoteItemStatus;
use Kumi\Senzou\Support\Enums\RequestNoteRemarks;
use Kumi\Senzou\Support\Enums\RequestNoteStatus;

class RequestNoteController
{
    public function index()
    {
        $query = RequestNote::query();

        if (Auth::user()->isNahkoda()) {
            $user = Auth::user();

            $request_notes = $query
                ->byVessel($user->vessel_id)
                ->latest()
                ->paginate()
            ;
        } else {
            $user_id = Auth::id();

            $request_notes = $query
                ->where('vessel_user_id', $user_id)
                ->latest()
                ->paginate()
            ;
        }

        return view('senzou::request-notes.ship-crew.index', [
            'notes' => $request_notes,
            'remarks' => $this->getAssignedRemarks(),
            'delivery_requirements' => $this->getDeliveryRequirementOptions(),
        ]);
    }

    public function create()
    {
        return view('senzou::request-notes.ship-crew.create', [
            'remarks' => $this->getAssignedRemarks(),
            'delivery_requirements' => $this->getDeliveryRequirementOptions(),
            'default_delivery_requirement' => RequestNoteDeliveryRequirements::NORMAL,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => ['required'],
            'voyage_number' => ['required'],
            'remarks' => [
                'required',
                Rule::in($this->getAssignedRemarks()),
            ],
            'delivery_requirement' => [
                'required',
                Rule::in($this->getDeliveryRequirementOptions()),
            ],
        ]);

        $validated['vessel_user_id'] = auth()->id();
        $validated['status'] = RequestNoteStatus::PENDING;

        $request_note = RequestNote::create($validated);

        $items = collect($request->get('items'))
            ->reject(function (array $attributes) {
                return is_null($attributes['name']);
            })
            ->map(function (array $attributes) {
                $attributes['status'] = RequestNoteItemStatus::PENDING;

                return new RequestNoteItem($attributes);
            });

        $request_note->items()->saveMany($items);

        return redirect()->route('senzou.request-notes.index')
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(RequestNote $request_note)
    {
        return view('senzou::request-notes.ship-crew.view', compact('request_note'));
    }

    public function edit(RequestNote $request_note)
    {
        return view('senzou::request-notes.ship-crew.edit', [
            'request_note' => $request_note,
            'remarks' => $this->getAssignedRemarks(),
            'delivery_requirements' => $this->getDeliveryRequirementOptions(),
            'default_delivery_requirement' => RequestNoteDeliveryRequirements::NORMAL,
        ]);
    }

    public function update(RequestNote $request_note, Request $request)
    {
        $validated = $request->validate([
            'location' => ['required'],
            'voyage_number' => ['required'],
            'remarks' => [
                'required',
                Rule::in($this->getAssignedRemarks()),
            ],
            'delivery_requirement' => [
                'required',
                Rule::in($this->getDeliveryRequirementOptions()),
            ],
        ]);

        $request_note->update($validated);

        $old_items = collect($request->get('old_items'))
            ->reject(function (array $attributes) {
                return is_null($attributes['name']);
            })
            ->map(function (array $attributes, $index) {
                return RequestNoteItem::find($index)
                    ->fill($attributes)
                ;
            });

        $new_items = collect($request->get('items'))
            ->reject(function (array $attributes) {
                return is_null($attributes['name']);
            })
            ->map(function (array $attributes) {
                $attributes['status'] = RequestNoteItemStatus::PENDING;

                return new RequestNoteItem($attributes);
            });

        $request_note->items()->saveMany($old_items->merge($new_items));

        return redirect()->route('senzou.request-notes.index')
            ->with('success', 'dashboard updated successfully');
    }

    public function destroy($id)
    {
        $request_notes = RequestNote::findOrFail($id);
        $request_notes->items()->delete();
        $request_notes->delete();

        return redirect()->route('senzou.request-notes.index')
            ->with('success', 'Deleted successfully');
    }

    protected function getAssignedRemarks(): string
    {
        if (Auth::user()->isChiefOfficer()) {
            return RequestNoteRemarks::DECK;
        }

        if (Auth::user()->isKKM()) {
            return RequestNoteRemarks::ENGINE;
        }

        return 'N/A';
    }

    protected function getDeliveryRequirementOptions(): array
    {
        return [
            RequestNoteDeliveryRequirements::URGENT,
            RequestNoteDeliveryRequirements::NORMAL,
        ];
    }
}
