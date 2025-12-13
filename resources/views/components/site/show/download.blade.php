@props([
    'product' => 'product',
])

@php
    $files = $product->files;
    $productName = $product->name;

@endphp
<div>
    <table class="tf-table-page-cart">
        <tbody>
            @foreach ($files as $file)
                <tr class="tf-cart-item1 file-delete">
                    <td class="tf-cart-item_product">
                        {{-- <i class="fas fa-file-pdf me-2 fs-2 text-danger"></i>
                        {{ $file->file_name }} --}}

                        <img src="{{ getFileIcon($file->path) }}" alt="File Icon" width="32">
                        {{ $product->name }} - {{ $file->file_name }}

                    </td>

                    <td>
                        <span class="fs-12">
                            <small style=" font-size: 12px; ">
                                File size:
                            </small>
                            <strong>{{ formatFileSize($file->size) }}</strong>
                        </span>
                    </td>


                    <td class="remove-cart text-end">
                        <span class="fs-12">
                            <small style=" font-size: 10px; ">Last updated:</small>
                            {{ date('d M Y', strtotime($file->created_at)) }}
                        </span>
                        <a href="{{ url('download-file/' . $file->id) }}"
                            class="d-flex justify-content-end  link-danger link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover">
                            <i class="fas fa-download me-2"></i>
                            <span>Download</span>
                        </a>

                        {{-- <a href="{{ asset('storage/' . $file->path, []) }}" download="{{ $productName }}"
                            class="d-flex justify-content-end  link-danger link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover">
                            <i class="fas fa-download me-2"></i>
                            <span>Download</span>
                        </a> --}}


                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
