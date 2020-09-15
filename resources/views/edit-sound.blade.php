<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            อัพโหลดเสียง
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="content bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="title">แก้ไขชื่อชุดเสียง</div>
                <form action="/admin/sound/updatePackagename" method="POST">
                    @csrf
                    <input name="id" type="hidden" value={{$query->id}}>
                    <input name="name" class="form-control" placeholder="ตัวอย่าง 'ธรรมะสวัสดี'" value="{{$query->sound_package_name}}" required>
                    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
                        <x-jet-button type="submit">บันทึก</x-jet-button>
                    </div>
                </form>
                <hr>
                <div class="title">อัพโหลดภาพหน้าปก</div>
                <form action="/admin/sound/updateCoverImage" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="id" type="hidden" value={{$query->id}}>
                    <input type="hidden" name="folder" value={{$query->sound_package_folder}}>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" required>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
                        @if ($query->package_image != null)
                            <a href="/sound_resource/{{$query->sound_package_folder}}/{{$query->package_image}}" style="margin-right: 1em;">ดูปกปัจจุบัน</a>
                        @endif
                        <x-jet-button type="submit">บันทึก</x-jet-button>
                    </div>
                </form>
                <hr>
                <div class="title">อัพโหลดไฟล์เสียง</div>
                คลิก Choose File จากนั้นเลือกไฟล์เสียงที่ต้องการอัพโหลดหลังจากนั้นคลิกปุ่มอัพโหลด
                <form action="/admin/sound/uploadfile" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-between px-4 py-3 sm:px-6 row">
                        
                        <input type="hidden" name="id" value={{$query->id}}>
                        <input type="hidden" name="folder" value={{$query->sound_package_folder}}>
                        <div class="custom-file col-12 col-md-8 col-lg-9">
                            <input type="file" name="file" class="custom-file-input" id="sound-file-input" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3 text-right">
                            <x-jet-button type="submit" onclick="showMessage()">อัพโหลดเสียง</x-jet-button>
                        </div>
                        <div id="upload-alert" class="col-12 alert alert-success" style="margin-top: 1em; display:none;">
                            กำลังอัพโหลด...
                        </div>
                    </div>
                </form>
                <?php $i = 1;?>
                <table class="table table-striped ">
                    <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อไฟล์</th>
                        <th>ฟังตัวอย่าง</th>
                        <th>ลบไฟล์</th>
                    </tr>
                    @foreach ($files as $file)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$file->sound_file}}</td>
                        <td>
                        <a href="/sound_resource/{{$query->sound_package_folder}}/{{$file->sound_file}}" target="_blank" class="play-link">
                                <i class="fas fa-play-circle"></i>
                            </a>
                        </td>
                        <td>
                            <a href="/admin/sound/deleteFile?sound_id={{$file->sound_id}}&package_id={{$query->id}}&folder={{$query->sound_package_folder}}&file={{$file->sound_file}}" class="delete-link" onclick="return confirmDeleteFile()">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php $i = $i + 1;?>
                    @endforeach
                </table>
                <hr>
                <div class="title">ลบชุดไฟล์เสียง</div>
                ไฟล์เสียงทั้งหมดจะถูกลบทั้งหมดออกจากระบบ
                <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
                    <form action="/admin/sound/deletePackage" method="POST">
                        @csrf
                        <input type="hidden" name="id" value={{$query->id}}>
                        <input type="hidden" name="folder" value={{$query->sound_package_folder}}>
                        <x-jet-danger-button type="submit" onclick="return confirmDelete()">ลบชุดไฟล์เสียง</x-jet-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete(){
        var confirmDelete = confirm('ต้องการลบชุดไฟล์เสียงชุดนี้หรือไม่');
        if (confirmDelete){
            return true;
        }else{
            return false;
        }
    }

    function confirmDeleteFile(){
        var confirmDelete = confirm('ต้องการลบไฟล์เสียงนี้หรือไม่');
        if (confirmDelete){
            return true;
        }else{
            return false;
        }
    }

    function showMessage(){
        var file = document.getElementById('sound-file-input');
        var uploadAlert = document.getElementById('upload-alert');
        if(file.checkValidity()){
            uploadAlert.style.display = "block";
        }
    }

    $('.custom-file-input').on('change', function(){
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })
</script>