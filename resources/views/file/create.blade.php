<x-app-layout>
    {{-- app.blade.php의 $header 슬롯에 들어간다 --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            신규파일등록
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <form method="post" action="{{route('file.store')}}" enctype="multipart/form-data">
                {{-- XSS방지를 위해서 CSRF를 추가한다(XSS란 유저가 요청한 페이지에 악성스크립트를 삽입해서 악의적동작이 실행되는 공격) --}}
                {{-- Laravel의 Form태그는 CSRF가 필수이다 --}}
                @csrf
                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                    <label for="filename" class="font-semibold leading-none mt-4">파일명</label>
                    <input type="text" name="filename" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="filename" placeholder="파일명을 입력해주세요">
                    </div>
                </div>
                <div class="w-full flex flex-col">
                    <label for="image" class="font-semibold leading-none mt-4">선택된 파일</label>
                    <div>
                    <input id="image" type="file" name="image">
                    </div>
                </div>
                {{-- component의 primary-button.blade.php의 $slot의 슬롯에 들어간다 --}}
                <x-primary-button class="mt-4">
                    저장
                </x-primary-button>
                
            </form>
        </div>
    </div>
</x-app-layout>