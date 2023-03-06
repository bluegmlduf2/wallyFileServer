<x-app-layout>
    {{-- app.blade.php의 $header 슬롯에 들어간다 --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            파일편집
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="mt-10 sm:mt-0 mx-auto">
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form action="#" method="POST">
                    <div class="overflow-hidden shadow rounded-lg">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="filename"
                                        class="block text-sm font-medium leading-6 text-gray-900">파일명</label>
                                    <input type="text" name="filename" id="filename" placeholder="파일명을 입력해주세요"
                                        value="{{ old('filename', $file->file_name) }}"
                                        class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="postal-code"
                                        class="block text-sm font-medium leading-6 text-gray-900">선택된 파일</label>
                                    <div class="mt-2">
                                        <img id="tempImg" src="{{ url('storage/files/' . $file->file_url) }}"
                                            style="max-height: 300px">
                                    </div>
                                    <div class="mt-3">
                                        <input id="file" type="file" name="file" 
                                            onchange="createTempImage()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <x-primary-button>
                                저장
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
