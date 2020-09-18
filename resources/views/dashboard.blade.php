<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ระบบแก้ไขเว็บไซต์ธรรมะ
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="content bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row">
                    <div class="col-6 col-md-4">
                        <a href="/admin/sound" class="access-block">
                            <div class="icon">
                                <i class="fas fa-volume-up"></i>
                            </div>
                            ฟังเสียง
                            <div class="description">อัพโหลดไฟล์เสียงเพื่อแสดงในเว็บไซต์</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
