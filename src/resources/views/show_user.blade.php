@include('includes.header')

<main>
    <section class="user-container">
        <div class="user-info">
            <!-- <img src="user-avatar.jpg" alt="User Avatar" class="avatar"> -->
            <img class="mt-3"
                src="{{ $user->image ? asset('images/' . $user->image) : 'https://via.placeholder.com/400x300' }}"
                alt="Product Image" class="product-img">
            <form action="{{ route('products_store', ["id" => $user->id]) }}" method="post"
                enctype="multipart/form-data" class="mt-2">
                @csrf
                <label for="fileInput" id="saveLabel">
                    LABEL:
                </label>
                <input name="imageUrl" id="fileInput" type="file" />
                <br>
                <button id="saveImageBtn" type="submit" class="btn btn-success" value="save image">
                    <i class=" fa-1x fa fa-save" style="cursor:pointer"></i> Save image

                </button>
            </form>
            <h2>{{ $user->name }}</h2>
            <p>Email: {{ $user->email }}</p>
            <p>Joined: {{ $user->created_at->format('F j, Y') }}</p>
        </div>

        <div class="user-actions">
            <a href="/edit-profile" class="button">Edit Profile</a>
            <a href="/logout" class="button">Logout</a>
        </div>
    </section>
</main>
@include('includes.footer')