@extends('admin.layouts.app')

@section('title', 'Artikel')

@section('content')

<div class="overflow-x-auto mt-12">
    <h3 class="text-xl font-bold mb-4">Data Artikel</h3>
    <div class="flex justify-between items-center mb-4">
        <x-primary-button class="justify-center space-x-2 px-2 py-2 rounded-md text-white">
            <a href="{{ route('admin.article.create') }}" class="flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 448 512" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                     <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
                </svg>
                <span>Tambah</span>
            </a>
        </x-primary-button>
       
    </div>
    <div class="overflow-x-auto">
        <table id="Table" class="table-auto w-full border-collapse border border-gray-200 text-sm sm:text-base">
            <thead>
                <tr class="bg-gray-150">
                    <x-table.th>No</x-table.th>
                    <x-table.th>Judul</x-table.th>
                    <x-table.th class="hidden sm:table-cell">Konten</x-table.th>
                    <x-table.th>Status</x-table.th>
                    <x-table.th class="hidden sm:table-cell">Publish</x-table.th>
                    <x-table.th>Aksi</x-table.th>
                </tr>
            </thead>
            <x-table.tbody>
                @foreach ($article as $data)
                <x-table.tr>
                    <x-table.td>{{ $loop->iteration }}</x-table.td>
                    <x-table.td>{{ $data->title }}</x-table.td>
                    <x-table.td class="hidden sm:table-cell">{!! \Illuminate\Support\Str::limit($data->content, 40) !!}</x-table.td>
                    <x-table.td>
                        @if ($data->status == 'published')
                        <x-status-label class="border-green-500 text-green-500">
                            Diterbitkan
                        </x-status-label>         
                        @elseif ($data->status == 'draft')
                        <x-status-label class="border-yellow-500 text-yellow-500">
                            Draft
                        </x-status-label>  
                        @elseif ($data->status == 'archived')
                        <x-status-label class="border-red-500 text-red-500">
                            Diarsipkan
                        </x-status-label>  
                        @endif
                    </x-table.td>
                    <x-table.td class="hidden sm:table-cell">{{ $data->published_at ? $data->published_at->format('d M Y') : '-' }}</x-table.td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex justify-center gap-2">
                            <x-edit-button class="w-15 h-8">
                                <a href="{{ route('admin.article.edit', $data->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                      </svg>
                                      
                                </a>
                            </x-edit-button>
                            <form action="{{ route('admin.article.destroy', $data->id) }}" method="POST" id="delete-form-{{ $data->id }}">
                                @csrf
                                @method('DELETE')
                               
                                <x-danger-button type="submit" class="delete-button w-15 h-8" data-id="{{ $data->id }}">
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
    
    
    {{-- <div class="space-y-4 sm:hidden">
        @foreach ($article as $data)
        <div class="bg-white border border-gray-200 shadow-sm rounded-lg p-4">
            <div class="flex justify-between">
                <span class="font-bold text-gray-700">No   :</span>
                <span>{{ $loop->iteration }}</span>
            </div>
            <div class="flex justify-between mt-2">
                <span class="font-bold text-gray-700">Judul:</span>
                <span>{{ $data->title }}</span>
            </div>
            <div class="flex justify-between mt-2">
                <span class="font-bold text-gray-700">Konten:</span>
                <span class="text-right">{!! \Illuminate\Support\Str::limit($data->content, 40) !!}</span>
            </div>
            <div class="flex justify-between mt-2">
                <span class="font-bold text-gray-700">Status:</span>
                <span>
                    @if ($data->status == 'published')
                    <x-status-label class="border-green-500 text-green-500">
                        Diterbitkan
                    </x-status-label>
                    @elseif ($data->status == 'draft')
                    <x-status-label class="border-yellow-500 text-yellow-500">
                        Draft
                    </x-status-label>
                    @elseif ($data->status == 'archived')
                    <x-status-label class="border-red-500 text-red-500">
                        Diarsipkan
                    </x-status-label>
                    @endif
                </span>
            </div>
            <div class="flex justify-between mt-2">
                <span class="font-bold text-gray-700">Publish:</span>
                <span>{{ $data->published_at ? $data->published_at->format('d M Y') : '-' }}</span>
            </div>
            <div class="flex justify-center gap-2 mt-4">
                <x-edit-button>
                    <a href="{{ route('admin.article.edit', $data->id) }}">Edit</a>
                </x-edit-button>
                <form action="{{ route('admin.article.destroy', $data->id) }}" method="POST" id="delete-form-{{ $data->id }}">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit" class="delete-button" data-id="{{ $data->id }}">
                        Hapus
                    </x-danger-button>
                </form>
            </div>
        </div>
        @endforeach
    </div> --}}
    
</div>
@endsection