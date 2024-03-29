@if (session('success'))
<div id="flash-message" role="alert" class="rounded-xl border border-gray-100 bg-white p-4 mb-2">
  <div class="flex items-start gap-4">
    <span class="text-green-600">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="h-6 w-6"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
        />
      </svg>
    </span>

    <div class="flex-1">
      <strong class="block font-medium text-gray-900"> {{session('success')}} </strong>
    </div>

    <button id="close-flash-message" class="text-gray-500 transition hover:text-gray-600" data-mdb-dismiss="alert">
      <span class="sr-only">Dismiss popup</span>

      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="h-6 w-6"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M6 18L18 6M6 6l12 12"
        />
      </svg>
    </button>
  </div>
</div>
@endif

@if ($errors->any())
<div role="alert" class="rounded border-s-4 border-red-500 bg-red-50 p-4">
  <strong class="block font-medium text-red-800"> Quelque chose c'est mal passer </strong>
  <ul class="mt-2 text-sm text-red-700">
    @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
  </ul>
</div>
@endif



