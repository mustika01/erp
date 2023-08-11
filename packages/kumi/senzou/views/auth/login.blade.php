@extends('senzou::layouts.app')
@section('content')

<div class="container mx-auto max-w-full py-24 px-6">
  <div class="mx-auto max-w-sm px-6">
      <div class="relative flex flex-wrap">
          <div class="relative w-full">
              <div class="mt-6">
                  <div class="mt-6 text-center font-semibold">
                      <h2 class="mt-6 text-3xl font-bold text-gray-900">
                          Vessel User
                      </h2>
                  </div>

                  <div class="mt-2 text-center text-sm text-gray-500">
                      Please sign in to your account
                  </div>

                  <x-senzou::card class="mt-8">
                      <form method="POST" action="{{ route('senzou.login') }}">
                          @csrf
                          <div class="mx-auto max-w-lg">
                              <div class="py-2">
                                  <span class="text-sm text-gray-600">{{ __('Email') }}</span>
                                  <input type="text" id="email" name="email"
                                      class="text-md form-control @error('email') is-invalid @enderror mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:outline-none"
                                      value="{{ old('email') }}" required autocomplete="email" autofocus />

                                  @error('email')
                                      <span class="invalid-feedback text-black-500 mt-2 text-sm" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror

                              </div>

                              <div class="py-2" x-data="{ show: true }">
                                  <span class="text-sm text-gray-600">{{ __('Password') }}</span>
                                  <div class="relative">
                                      <input id="password" name="password" :type="show ? 'password' : 'text'"
                                          class="text-md form-control @error('password') is-invalid @enderror mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:outline-none"
                                          required autocomplete="current-password">

                                      @error('password')
                                          <span class="invalid-feedback text-black-500 mt-2 text-sm" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror

                                      <div
                                          class="absolute inset-y-0 right-0 flex items-center pr-3 text-sm leading-5">

                                          <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                              :class="{ 'hidden': !show, 'block': show }"
                                              xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512">
                                              <path fill="currentColor"
                                                  d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                              </path>
                                          </svg>

                                          <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                              :class="{ 'block': !show, 'hidden': show }"
                                              xmlns="http://www.w3.org/2000/svg" viewbox="0 0 640 512">
                                              <path fill="currentColor"
                                                  d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                              </path>
                                          </svg>

                                      </div>
                                  </div>
                              </div>

                              <div class="mt-2 mb-4 flex items-center">
                                  <input id="remember" type="checkbox" name="remember"
                                      class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800">
                                  <label for="remember"
                                      class="ml-2 mb-0 text-sm font-medium text-gray-900 dark:text-gray-300">
                                      Remember me?
                                  </label>
                              </div>

                              <button type="submit"
                                  class="mr-2 mb-2 block w-full rounded-lg bg-gray-800 px-5 py-2.5 text-sm font-medium text-white focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:focus:ring-gray-700">
                                  Login
                              </button>

                          </div>
                      </form>

                  </x-senzou::card>


              </div>
          </div>


<main>
@endsection


