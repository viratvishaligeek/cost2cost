@php
    $types = [
        'success' => ['color' => 'success', 'icon' => 'uil-check-circle'],
        'error' => ['color' => 'danger', 'icon' => 'uil-times-circle'],
        'warning' => ['color' => 'warning', 'icon' => 'uil-exclamation-triangle'],
        'info' => ['color' => 'info', 'icon' => 'uil-info-circle'],
    ];
@endphp

<style>
    .toast-custom {
        min-width: 280px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        border-left: 5px solid;
        animation: toastSlide .4s ease;
    }

    .toast-success {
        border-color: #28a745;
    }

    .toast-danger {
        border-color: #dc3545;
    }

    .toast-warning {
        border-color: #ffc107;
    }

    .toast-info {
        border-color: #0dcaf0;
    }

    .toast-body {
        font-size: 14px;
    }

    @keyframes toastSlide {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>
<div class="position-fixed top-0 end-0 p-3" style="z-index:1080">

    @foreach ($types as $key => $type)
        @if (session()->has($key))
            <div class="toast toast-custom toast-{{ $type['color'] }} mb-3 show" role="alert" data-bs-delay="5000">

                <div class="toast-body p-0 d-flex align-items-center">

                    <span class="{{ $type['icon'] }} text-{{ $type['color'] }} fs-4 me-2"></span>

                    <div class="grow">
                        {{ session($key) }}
                    </div>

                    <button class="btn p-0 ms-2" data-bs-dismiss="toast">
                        <span class="uil uil-times fs-5 text-muted"></span>
                    </button>

                </div>

            </div>
        @endif
    @endforeach


    {{-- Validation Errors --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="toast toast-custom toast-danger mb-3 show" role="alert" data-bs-delay="5000">

                <div class="toast-body p-0 d-flex align-items-center">

                    <span class="uil uil-times-circle text-danger fs-4 me-2"></span>

                    <div class="grow">
                        {{ $error }}
                    </div>

                    <button class="btn p-0 ms-2" data-bs-dismiss="toast">
                        <span class="uil uil-times fs-5 text-muted"></span>
                    </button>

                </div>

            </div>
        @endforeach
    @endif

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        var toastElList = [].slice.call(document.querySelectorAll('.toast'))

        toastElList.forEach(function(toastEl) {

            var toast = new bootstrap.Toast(toastEl, {
                delay: 5000
            })

            toast.show()

        })

    })
</script>
