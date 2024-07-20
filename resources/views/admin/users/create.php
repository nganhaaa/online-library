<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Other form fields -->
    <div class="form-group">
        <label for="image">Book Image:</label>
        <input type="file" class="form-control" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
