<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ভাগ্যের চাকা</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 m-auto mt-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">ভাগ্যের চাকা</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('career_wheel_post') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">
                                    ফোন নাম্বার (০১৭xxxxxxxx)
                                </label>
                                <input type="text" class="form-control @error ('phone_number') is-invalid @enderror" id="phone_number" name="phone_number">
                                @error ('phone_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">আপনি কোন ধরনের ব্যাচে আগ্রহী?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="course_type" id="online_radio" value="online" checked {{ (old('course_type') == 'online') ? 'checked':'' }}>
                                    <label class="form-check-label" for="online_radio">
                                        অনলাইন
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="course_type" id="offline_radio" value="offline" {{ (old('course_type') == 'offline') ? 'checked':'' }}>
                                    <label class="form-check-label" for="offline_radio">
                                        অফলাইন
                                    </label>
                                </div>
                                @error ('course_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                সাবমিট
                            </button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        আমার কাছে কোড আছে। <a href="{{ url('verification') }}">ক্লিক করুন</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
