@extends('admin.layouts.app')

@section('title', 'Makanan Pilihan')

@section('content')

<div class="mt-12 overflow-x-auto">
    <h3 class="mb-4 text-xl font-bold">Data Makanan</h3>
    <div class="flex items-center gap-2 mb-4">
        <x-primary-button class="justify-center space-x-2 px-2 py-2 rounded-md text-white">
            <a href="{{ route('admin.clean-food.create') }}" class="flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 448 512" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                     <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
                </svg>
                <span>Tambah</span>
            </a>
        </x-primary-button>
        <x-edit-button class="bg-yellow-500 hover:bg-yellow-600 flex items-center justify-center space-x-2 px-4 py-2 rounded-md text-white">
            <a href="{{ route('admin.food-export') }}" class="flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
                <span>Ekspor</span>
            </a>
        </x-edit-button>
        <form action="{{ route('admin.food-import') }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-4">
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
    <table id="Table" class="w-full text-sm border border-collapse border-gray-200 table-auto sm:text-base">
        <thead>
            <tr class="bg-gray-150">
                <x-table.th>No</x-table.th>
                <x-table.th>Nama Makanan</x-table.th>
                <x-table.th>Jenis</x-table.th>
                <x-table.th>Tipe</x-table.th>
                <x-table.th>Aksi</x-table.th>
            </tr>
        </thead>
        <x-table.tbody>
            @foreach ($food as $data)
            <x-table.tr>
                <x-table.td  class="text-left">{{ $loop->iteration }}</x-table.td>
                <x-table.td>{{ $data->food_name }}</x-table.td>
                <x-table.td>{{ $data->foodGroup->group }}</x-table.td>
                <x-table.td>{{ $data->foodType->type }}</x-table.td>
                <td class="px-6 py-3 text-center">
                    <div class="flex justify-center gap-2">
                        <x-edit-button class="h-8 w-15">
                            <a href="{{ route('admin.clean-food.show', $data->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                  </svg>
                                  
                            </a>
                        </x-edit-button>
                        <x-edit-button class="h-8 bg-yellow-500 w-15 hover:bg-yellow-600">
                            <a href="{{ route('admin.clean-food.edit', $data->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                  </svg>
                                  
                            </a>
                        </x-edit-button>
                       
                        <form action="{{ route('admin.clean-food.destroy', $data->id) }}" method="POST" id="delete-form-{{ $data->id }}">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit" class="h-8 delete-button w-15" data-id="{{ $data->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                  </svg>
                            </x-danger-button>
                        </form>
                    </div>
                </td>
            </x-table.tr>
            @endforeach
        </x-table.tbody>
    </table>
</div>
@endsection
