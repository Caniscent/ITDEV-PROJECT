@extends('admin.layouts.app')

@section('title', 'Jenis Makanan')

@section('content')

<div class="overflow-x-auto mt-12">
    <h3 class="text-xl font-bold mb-4">Data Jenis</h3>
    <div class="flex gap-2 items-center mb-4">
        <x-primary-button class="justify-center space-x-2 px-2 py-2 rounded-md text-white">
            <a href="{{ route('admin.food-group.create') }}" class="flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 448 512" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                     <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
                </svg>
                <span>Tambah</span>
            </a>
        </x-primary-button>
        <x-edit-button class="bg-yellow-500 hover:bg-yellow-600 flex items-center justify-center space-x-2 px-4 py-2 rounded-md text-white">
            <a href="{{ route('admin.group-export') }}" class="flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
                <span>Ekspor</span>
            </a>
        </x-edit-button>
        <form action="{{ route('admin.group-import') }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-4">
            @csrf
            <input type="file" name="import" required 
                   class="block w-48 text-sm text-gray-500 file:mr-4 file:py-2 file:px-2 file:rounded file:border file:border-gray-300 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
            <x-edit-button type="submit" class="flex items-center justify-center space-x-2 px-2 py-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor" class="w-5 h-5">
                    <path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 38.6C310.1 219.5 256 287.4 256 368c0 59.1 29.1 111.3 73.7 143.3c-3.2 .5-6.4 .7-9.7 .7L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zm48 96a144 144 0 1 1 0 288 144 144 0 1 1 0-288zm16 80c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 48-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 0 48c0 8.8 7.2 16 16 16s16-7.2 16-16l0-48 48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0 0-48z"/>
                </svg>
                <span>Impor</span>
            </x-edit-button>
        </form>
        
    </div>
    <table id="Table" class="table-auto w-full border-collapse border border-gray-200 text-sm sm:text-base">
        <thead>
            <tr class="bg-gray-150">
                <x-table.th>No</x-table.th>
                <x-table.th>Nama</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Deskripsi</x-table.th>
                <x-table.th>Aksi</x-table.th>
            </tr>
        </thead>
        <x-table.tbody>
            @foreach ($food as $data)
            <x-table.tr>
                <x-table.td>{{ $loop->iteration }}</x-table.td>
                <x-table.td>{{ $data->group }}</x-table.td>
                <x-table.td>
                    @if ($data->status == true)
                        <x-status-label class="border-green-500 text-green-500">
                            aktif
                        </x-status-label>
                    @elseif ($data->status == false)
                        <x-status-label class="border-red-500 text-red-500">
                                tidak aktif
                        </x-status-label>
                    @endif
                </x-table.td>
                <x-table.td>{{ $data->description }}</x-table.td>
                <td class="py-3 px-6 text-center">
                    <div class="flex justify-center gap-2">
                        <x-edit-button class="h-8 bg-yellow-500 w-15 hover:bg-yellow-600">
                            <a href="{{ route('admin.food-group.edit', $data->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                  </svg>
                                  
                            </a>
                        </x-edit-button>
            </td>
        </div>
            </x-table.tr>
            @endforeach
        </x-table.tbody>
    </table>
</div>
@endsection
