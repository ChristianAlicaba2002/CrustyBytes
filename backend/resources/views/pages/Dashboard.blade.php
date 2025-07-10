<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../../../assets/logo.webp" type="image/x-icon">
    <title>{{ Auth::guard('admin')->user()->name }} Dashboard</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .header-container {
        background: #fff;
        padding: 2rem 2rem;
        border-bottom: 1px solid #eee;
    }

    .header-container h1 {
        margin-left: 15rem;
        margin-bottom: 0.5rem;
        font-size: 2.5rem;
        color: #333;
    }

    .header-container p {
        margin-left: 15rem;
        color: #666;
        margin-bottom: 0.5rem;
    }

    .table-container {
        width: 100%;
        height: 54vh;
        overflow-y: scroll;
        scrollbar-width: none;
    }

    .table-container input[type="search"] {
        width: 30rem;
        border-radius: 6px;
        border: 0;
        padding: 1.2rem;
        margin-top: 1.2rem;
        margin-bottom: -1rem;
        font-size: 1rem;
        color: #8d8d8d80;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        margin: 2rem 0;
        border-collapse: collapse;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-table th,
    .custom-table td {
        padding: 0.75rem 3rem;
        border: 1px solid #eee;
        text-align: left;
    }

    .custom-table thead tr {
        background: #efefef;
        position: sticky;
        top: -0.20rem;
    }

    .custom-table .product-image {
        width: 60px;
        height: 55px;
        border-radius: 50%;
    }

    .available-yes {
        color: green;
    }

    .available-no {
        color: red;
    }

    .main-content {
        display: flex;
        flex-direction: column;
        position: absolute;
        /* top: 0; */
        margin-left: 13%;
    }

    .button-container {
        display: flex;
        flex-direction: row;
        gap: 1.2rem;
    }

    .button-container button {
        border: 0;
        background-color: transparent;
    }

    .button-container img {
        width: 25px;
        height: 25px;
    }

    .update-modal-overlay {
        display: none;
        position: fixed;
        z-index: 50;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.3);
    }
</style>

<body>
    <nav>
        @include('Components.Sidebar')
    </nav>

    <header class="header-container">
        <h1>{{ Auth::guard('admin')->user()->name }} Dashboard</h1>
        <p>This is the main page for administrators to manage the application.</p>
        <p>Use the sidebar to navigate through different sections.</p>
        @include('Components.Badges')
    </header>
    <main class="main-content">
        @include('Components.Form')
        <div class="table-container">
            <input type="search" name="search" id="search" placeholder="Search product...">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Available</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                @if ($item->image)
                                    <img class="product-image" src="{{ asset('/images/' . $item->image) }}"
                                        alt="Image">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->category }}</td>
                            <td>{{ $item->size }}</td>
                            <td>&#8369;{{ number_format($item->price, 2) }}</td>
                            <td>
                                @if ($item->is_available)
                                    <span class="available-yes">Yes</span>
                                @else
                                    <span class="available-no">No</span>
                                @endif
                            </td>
                            <td>
                                <div class="button-container">
                                    <button type="button"
                                        onclick="editProduct('{{ $item->id }}', '{{ $item->name }}', '{{ $item->description }}', '{{ $item->category }}', '{{ $item->size }}', '{{ $item->price }}', '{{ $item->is_available }}' , '{{ $item->image }}')">
                                        <img style="cursor: pointer;" src="../../../assets/edit.webp" alt="">
                                    </button>
                                    <form action="{{ route('archive.product', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <img style="cursor: pointer;" src="../../../assets/delete.webp"
                                                alt="">
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Updated Form --}}
        <div id="updateFormModal" class="update-modal-overlay">
            <div class="modal-content">
                <button type="button" id="closeUpdateModalBtn" class="modal-close-btn">&times;</button>
                <form id="updateForm" method="post" enctype="multipart/form-data" class="form-container">
                    @csrf
                    @method('PUT')
                    <h1>Update Product</h1>
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="nameID" required class="form-input">
                        <input type="number" name="id" id="idID" hidden>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="descriptionID" rows="3" required class="form-textarea"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="categoryID" required class="form-input">
                            <option value="">Select Category</option>
                            <option value="pizza">Pizza</option>
                            <option value="drink">Drink</option>
                            <option value="dessert">Dessert</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="size" class="form-label">Size</label>
                        <select name="size" id="sizeID" class="form-input" required>
                            <option value="">Select Size</option>
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" id="priceID" step="0.01" required class="form-input">
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="imageID" accept="image/*" class="form-file">
                    </div>

                    <div class="form-flex">
                        <input type="checkbox" name="is_available" id="is_availableID" class="form-checkbox">
                        <label for="is_availableID" class="form-checkbox-label">Available</label>
                    </div>

                    <div>
                        <button type="submit" class="form-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function editProduct(id, name, description, category, size, price, is_available, image) {
                document.getElementById('updateFormModal').style.display = 'block'
                document.getElementById('updateForm').action = `/update_product/${id}`

                document.getElementById('idID').value = id
                document.getElementById('nameID').value = name
                document.getElementById('descriptionID').value = description
                document.getElementById('categoryID').value = category
                document.getElementById('sizeID').value = size
                document.getElementById('priceID').value = price
                document.getElementById('is_availableID').checked = is_available
                document.getElementById('imageID').value = image

                document.getElementById('closeUpdateModalBtn').onclick = function() {
                    document.getElementById('updateFormModal').style.display = 'none';
                };

            }
        </script>
</body>

</html>
