<form action="{{ isset($delete) ? $delete : '/' }}" method="POST" data-confirm="{{ $confirm_message ?? '' }}" onsubmit="event.preventDefault(); return confirmDelete(this)">
     @if (isset($delete))
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger" title="Hapus Product"><i class="mdi mdi-delete-sweep"></i>
            Hapus</button>
    @endif
 </form>
    @if (isset($edit))
        <a class="btn btn-secondary" title="Edit Produk" href="{{ $edit }}"><i class="mdi mdi-pencil"></i>
            Edit</a>
    @endif

    @if (isset($view))
        <a class="btn btn-secondary" title="Lihat" href="{{ $view }}"><i class="mdi mdi-file-find"></i>
            View</a>
    @endif
@if (isset($approve))
    <form action="{{ $approve }}" method="POST" data-confirm="Apakah anda akan menerima ini?"
        style="margin-bottom: 5px" onsubmit="event.preventDefault(); return confirmDelete(this)">
        @csrf
        <button type="submit" class="btn btn-secondary" title="Approve data"><i class="mdi mdi-check"></i>
            Approve</button>
    </form>
@endif