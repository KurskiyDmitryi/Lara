@extends('layout.app')
@section('title','Client Form')
@section('content')
    <div>
        <p class="succes"></p>
    </div>
    <div>
        <div class="mb-3" id="name">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="name" name="name">
            <p class="message"></p>
        </div>
        <div class="mb-3" id="surname">
            <label for="exampleFormControlInput1" class="form-label">Surname</label>
            <input type="text" class="form-control" id="surname" placeholder="surname" name="surname">
            <p class="message"></p>
        </div>
        <div class="mb-3" id="age">
            <label for="exampleFormControlInput1" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" placeholder="age" name="age">
            <p class="message"></p>
        </div>
        <button class="btn btn-danger">Submit</button>
    </div>
    <script>
        function reset() {
            $('input#name').val('');
            $('input#surname').val('');
            $('input#age').val('');
        }
        $(document).ready(function () {
            $('.btn-danger').on('click', function () {
                $('.message').html('').removeClass('alert-danger')
                $('.succes').html('').removeClass('alert-success')
                var name = $('input#name').val();
                var surname = $('input#surname').val();
                var age = $('input#age').val();
                    $.ajax({
                    method: "POST",
                    url: "{{route('clientAdd')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name, surname: surname, age: age,
                    },
                    success: function (data) {
                        if (data) {
                            $('.succes').html('Data update').addClass('alert alert-success')
                        }
                    },
                    error: function (xhr) {
                        if (xhr) {
                            var errors = (JSON.parse(xhr.responseText))
                            errors = errors['errors'];
                            for (const [key, value] of Object.entries(errors)) {
                                $('#' + key + ' p').html(value).addClass('alert alert-danger')
                            }
                        }
                    }
                })
                reset()
            })
        })
    </script>
@endsection
