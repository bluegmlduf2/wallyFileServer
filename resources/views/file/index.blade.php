<x-app-layout>
    {{-- app.blade.php의 $header 슬롯에 들어간다 --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            파일목록
        </h2>
        <x-input-error class="mb-4" :messages="$errors->all()" />
        <x-message :message="session('message')" />
    </x-slot>
    <div class="mx-auto px-4">
        <div class="pb-4 mt-8">
             <div class="relative mt-1">
                <input type="text" id="table-search"
                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded w-80 bg-gray-50"
                    placeholder="파일명 검색">
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md">
            <table class="w-full text-sm text-left text-gray-500 mt-3">
                <thead class="uppercase bg-gray-500 text-white">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox"
                                    class="w-4 h-4 border-gray-300 rounded ">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            파일명
                        </th>
                        <th scope="col" class="px-6 py-3">
                            URL
                        </th>
                        <th scope="col" class="px-6 py-3">
                            파일타입
                        </th>
                        <th scope="col" class="px-6 py-3">
                            작성일자
                        </th>
                        <th scope="col" class="px-6 py-3">
                            
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $file)
                        <tr class="border bg-white">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-table-search-1" type="checkbox"
                                        class="w-4 h-4  border-gray-300 rounded">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $file->file_name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ url('storage/files/' . $file->file_url) }}
                                <svg class="h-5 w-5 flex-shrink-0 text-gray-400 inline cursor-pointer"
                                    onclick="copyText('{{ url('storage/files/' . $file->file_url) }}')" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z">
                                    </path>
                                    <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                                </svg>
                            </td>
                            <td class="px-6 py-4">
                                {{ $file->file_type }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $file->created_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('file.show', $file) }}"
                                    class="font-medium text-indigo-600 hover:underline">상세보기</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
