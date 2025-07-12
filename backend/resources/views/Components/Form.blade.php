<!-- Add Product Button -->
<button type="button" id="openModalBtn" class="form-submit add-product-btn">
    Add Product
</button>

<!-- Modal Structure -->
<div id="formModal" class="modal-overlay">
    <div class="modal-content">
        <button type="button" id="closeModalBtn" class="modal-close-btn">&times;</button>
        <form action="{{ route('create.product') }}" method="post" enctype="multipart/form-data" class="form-container">
            @csrf
            <h1>Add Product</h1>
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" required class="form-input">
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="3" class="form-textarea"></textarea>
            </div>

            <div class="form-group">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" required class="form-input">
                    <option value="">Select Category</option>
                    <option value="Pizza">Pizza</option>
                    <option value="Drink">Drink</option>
                    <option value="Dessert">Dessert</option>
                </select>
            </div>

            <div class="form-group">
                <label for="size" class="form-label">Size</label>
                <select name="size" id="size" class="form-input" required>
                    <option value="">Select Size</option>
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" step="0.01" required class="form-input">
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" accept="image/*" class="form-file">
            </div>

            <div class="form-flex">
                <input type="checkbox" name="is_available" id="is_available" class="form-checkbox">
                <label for="is_available" class="form-checkbox-label">Available</label>
            </div>

            <div>
                <button type="submit" class="form-submit">Submit</button>
            </div>
        </form>
    </div>
</div>

<style>
    .add-product-btn {
        max-width: 200px;
        margin-top: 2rem;
        display: block;
        background: #3490dc;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .add-product-btn:hover {
        background: #2779bd;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        z-index: 50;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.3);
    }

    .modal-content {
        position: relative;
        max-width: 32rem;
        margin: 5% auto;
        background: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        padding: 2rem;
    }

    .modal-close-btn {
        position: absolute;
        top: 0.5rem;
        right: 0.75rem;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #888;
        cursor: pointer;
    }

    .form-container {
        margin: 0;
    }

    .form-container h1 {
        margin-bottom: 1.5rem;
        font-size: 1.75rem;
        color: #333;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #333;
    }

    .form-input,
    .form-textarea,
    .form-file {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
        box-sizing: border-box;
    }

    .form-textarea {
        resize: vertical;
    }

    .form-flex {
        display: flex;
        align-items: center;
        margin-bottom: 1.25rem;
    }

    .form-checkbox {
        margin-right: 0.5rem;
    }

    .form-checkbox-label {
        font-size: 1rem;
        color: #333;
    }

    .form-submit {
        background: #38c172;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .form-submit:hover {
        background: #2d995b;
    }
</style>

<script>
    document.getElementById('openModalBtn').onclick = function() {
        document.getElementById('formModal').style.display = 'block';
    };
    document.getElementById('closeModalBtn').onclick = function() {
        document.getElementById('formModal').style.display = 'none';
    };
    document.getElementById('formModal').onclick = function(e) {
        if (e.target === this) this.style.display = 'none';
    };
</script>
