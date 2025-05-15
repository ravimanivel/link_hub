<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Link Hub Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .profile-card {
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            color: white;
            border-radius: 1rem;
            padding: 2rem;
        }

        .blog-post {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .blog-post:hover {
            transform: translateY(-5px);
        }

        .post-title {
            font-size: 1.25rem;
            color: #0d6efd;
        }

        .post-meta {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .link-url {
            word-break: break-all;
            font-size: 0.95rem;
        }
    </style>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @foreach ($user_det as $user)
        <input type="hidden" id="username" value="{{ $user['username'] }}">
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $.ajax({
                url: "{{ route('blog.view') }}",
                type: "GET",
                data: {
                    view: 1,
                    username: $('#username').val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log('View counted successfully');
                },
                error: function(xhr) {
                    console.error('Error counting view');
                }
            });
        });
    </script>
    <div class="container my-5">
        <!-- User Profile Section -->
        <div class="profile-card mb-5 text-center">
            @foreach ($user_det as $user)
                <h2 class="mb-1">{{ ucfirst($user['name']) }}</h2>
            @endforeach
        </div>

        <!-- Link Blog Section -->
        <div class="row g-4">
            @foreach ($link_det as $link)
            <div class="col-md-6 col-lg-4">
                <div class="blog-post p-4 h-100">
                <h5 class="post-title">{{ $link['link_title'] ?? 'Untitled Link' }}</h5>
                <p class="link-url mb-2">
                    <a href="{{ $link['link'] }}" onclick="count_view('{{ $link['id'] }}', '{{ $link['username'] }}')" target="_blank">{{ $link['link'] }}</a>
                </p>
                <p class="mb-1">{{ $link['link_description'] ?? 'No description available.' }}</p>
                <div class="post-meta mt-3">
                    <div><strong>Views:</strong> {{ $link['views'] }}</div>
                    <div><strong>Posted by:</strong> {{ $link['username'] }}</div>
                    <div><strong>Date:</strong>
                    {{ \Carbon\Carbon::parse($link['created_at'])->format('d M Y, H:i') }}</div>
                </div>
                </div>
            </div>
            @endforeach
            <script>
            function count_view(views_id, username) {
                $.ajax({
                url: "{{ route('blog.view.count') }}",
                type: "GET",
                data: {
                    id: views_id,
                    username: username,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(response) {
                    console.log('View counted view link successfully');
                },
                error: function(xhr) {
                    console.error('Error counting view');
                }
                });
            }
            </script>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
