<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../../../assets/logo.webp" type="image/x-icon">
    <title>{{ Auth::guard('admin')->user()->name }} Archive Items</title>
</head>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .table-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 2rem;
        background-color: #f9fafb;
        min-height: 100vh;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 7rem 0 0 0;
        background: #fff;
        border-collapse: collapse;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    thead tr {
        background: #efefef;
        position: sticky;
        top: -0.20rem;
    }

    th,
    td {
        padding: 0.75rem 3rem;
        border: 1px solid #eee;
        text-align: left;
    }

    th {
        background: #f3f4f6;
        font-weight: 600;
        color: #374151;
    }

    tr:hover {
        background: #f9fafb;
    }

    .product-image {
        width: 60px;
        height: 55px;
        border-radius: 50%;
    }

    h1 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        font-size: 2rem;
        color: #111827;
        font-weight: 700;
    }

    p {
        margin-bottom: 1.5rem;
        font-size: 1.125rem;
        color: #6b7280;
        line-height: 1.75rem;
        width: 75%;
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
</style>

<body>
    <nav>
        @include('Components.Sidebar')
    </nav>
    <div class="table-container">
        <h1>Archived Products</h1>
        <p>The Archive Items page displays previously removed or deactivated products, orders, or records from the main
            system. This section serves as a historical reference, allowing admins to review, restore, or permanently
            delete past entries. It helps keep the main inventory or data list clean while still preserving important
            records for auditing or future use.
        </p>
        <table>
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
                @if (count($archiveItems) > 0)
                    @foreach ($archiveItems as $item)
                        <tr>
                            <td>{{ $item->product_id }}</td>
                            <td><img class="product-image" src="{{ asset('images/' . $item->image) }}"
                                    alt="{{ $item->name }}" width="100"></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->category }}</td>
                            <td>{{ $item->size }}</td>
                            <td>&#8369;{{ $item->price }}</td>
                            <td>{{ $item->is_available ? 'Yes' : 'No' }}</td>
                            <td>
                                <div class="button-container">
                                    <button>
                                        <img style="cursor: pointer;" src="../../../assets/restore.webp" alt="">
                                    </button>
                                    <form action="{{ route('delete.product', $item->product_id) }}" method="post">
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
                @else
                    <tr>
                        <td colspan="9" style="color: red; font-weight:bold; text-align:center;">Don't have archive
                            product </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
