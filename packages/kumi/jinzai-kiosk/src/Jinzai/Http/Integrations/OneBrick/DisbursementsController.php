<?php

namespace Kumi\Jinzai\Http\Integrations\OneBrick;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Kumi\Jinzai\Models\Disbursement;
use Kumi\Jinzai\Support\Enums\DisbursementStatus;

class DisbursementsController
{
    public function __invoke(Request $request): JsonResponse
    {
        $payload = $request->get('data');
        $attributes = $payload['attributes'];

        $disbursement = Disbursement::query()
            ->firstWhere([
                'vendor_assigned_id' => $payload['id'],
                'reference_id' => $attributes['referenceId'],
            ])
        ;

        if (! $disbursement) {
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        }

        $data = [
            'status' => $attributes['status'],
        ];

        if ($attributes['status'] == DisbursementStatus::PROCESSING) {
            $data['processing_response'] = $request->all();
        }

        if ($attributes['status'] == DisbursementStatus::FAILED) {
            $data['failed_response'] = $request->all();
            $data['error_code'] = $attributes['errorCode'];
            $data['error_reason'] = $attributes['errorReason'];
        }

        if ($attributes['status'] == DisbursementStatus::COMPLETED) {
            $data['completed_response'] = $request->all();
        }

        $disbursement->update($data);

        return new JsonResponse($payload, Response::HTTP_OK);
    }
}
