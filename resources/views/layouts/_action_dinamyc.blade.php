<form action="{{ isset($delete) ? $delete : '/' }}" method="POST" data-confirm="{{ $confirm_message ?? '' }}" onsubmit="event.preventDefault(); return confirmDelete(this)">
     @if (isset($delete))
     @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data"><i class="mdi mdi-delete-sweep"></i>
            Hapus</button>
    @endif
    @if (isset($edit))
        <a class="btn btn-secondary  btn-sm" title="Edit Produk" href="{{ $edit }}"><i class="mdi mdi-pencil"></i>
            Edit</a>
    @endif

    @if (isset($view))
        <a class="btn btn-secondary  btn-sm" title="Lihat" href="{{ $view }}"><i class="mdi mdi-file-find"></i>
            View</a>
    @endif
 </form>

@if (isset($approve))
    <form action="{{ $approve }}" method="POST" data-confirm="Apakah anda akan menerima ini?"
        style="margin-bottom: 5px" onsubmit="event.preventDefault(); return confirmDelete(this)">
        @csrf
        <button type="submit" class="btn btn-secondary  btn-sm" title="Approve data"><i class="mdi mdi-check"></i>
            Approve</button>
    </form>
@endif