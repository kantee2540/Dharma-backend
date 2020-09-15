<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            อัพโหลดเสียง
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="content bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="detail d-flex justify-content-between">
                    ชุดไฟล์เสียงสามารถอัพโหลดได้โดยสร้างชุดไฟล์เสียงหลังจากนั้นอัพโหลดลงไฟล์เสียงลงไป <a href="/admin/sound/add" class="create-link">+ สร้างชุดไฟล์เสียง</a>
                </div>
                <div>
                    <div class="row">
                        @foreach($query as $data)
                        <div class="col-6 col-lg-4">
                            <a href="/admin/sound/{{$data->id}}" class="sound-package-item">
                                {{$data->sound_package_name}}
                            </a>
                            
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
