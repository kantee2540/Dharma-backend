<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            เพิ่มชุดไฟล์เสียง
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="addpackage" method="POST">
                @csrf
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="content">
                        ป้อนชื่อชุดไฟล์เสียง
                        <input name="name" class="form-control" placeholder="ตัวอย่าง 'ธรรมะสวัสดี'" required>
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <x-jet-button type="submit">บันทึก</x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
