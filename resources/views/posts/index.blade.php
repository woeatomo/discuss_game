@extends('layouts.app')

@section('content')
<div id="posts-container">
    <!-- Render post pertama -->
    @foreach($posts as $post)
        <div class="post" id="post-{{ $post->id }}">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
        </div>
    @endforeach
</div>
<div id="loading" style="display: none;">Loading...</div>
@endsection

@section('scripts')
<script>
    let page = 1; // Halaman awal
    let isLoading = false; // Status loading

    window.addEventListener('scroll', () => {
        if (isLoading) return;

        const { scrollTop, scrollHeight, clientHeight } = document.documentElement;

        // Cek apakah pengguna mendekati bagian bawah halaman
        if (scrollTop + clientHeight >= scrollHeight - 5) {
            loadMorePosts();
        }
    });

    async function loadMorePosts() {
        isLoading = true;
        page += 1;
        document.getElementById('loading').style.display = 'block';

        try {
            const response = await fetch(`/posts?page=${page}`);
            const data = await response.json();

            if (data.data.length === 0) {
                // Tidak ada data baru
                document.getElementById('loading').innerText = 'No more posts';
                return;
            }

            const container = document.getElementById('posts-container');

            data.data.forEach(post => {
                const postDiv = document.createElement('div');
                postDiv.classList.add('post');
                postDiv.id = `post-${post.id}`;
                postDiv.innerHTML = `
                    <h2>${post.title}</h2>
                    <p>${post.content}</p>
                `;
                container.appendChild(postDiv);
            });
        } catch (error) {
            console.error('Error loading more posts:', error);
        } finally {
            isLoading = false;
            document.getElementById('loading').style.display = 'none';
        }
    }
</script>
@endsection