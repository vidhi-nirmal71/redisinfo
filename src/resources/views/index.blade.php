@extends('redisinfo::layouts.app')

@section('redisinfo::content')

@if (isset($errors) && $errors->any())
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="alert alert-danger text-center shadow-lg p-4 rounded" style="max-width: 600px;">
            <h4 class="fw-bold"><i class="bi bi-exclamation-triangle-fill"></i> Error</h4>
            <ul class="list-unstyled mt-3">
                @foreach ($errors->all() as $error)
                    <li class="text-danger" style="font-size: 25px">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(isset($redisInstalled))
    <div class="container mt-5 main-container">
        @if ($redisInstalled)
            <h1 class="text-center mb-3">Redis Information</h1> 
            <div class="d-flex gap-3">
                <div class="col-md-6 flex-fill">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Redis System Statistics</div>
                        </div>
                        <div class="card-body">
                            <div class="card-text table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Total Keys</th>
                                            <td>{{ $redisDetails['total_keys'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Refresh</th>
                                            <td>{{ $redisDetails['last_refresh'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Redis Version</th>
                                            <td>{{ $redisDetails['redis_version'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Operating System</th>
                                            <td>{{ $redisDetails['os'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Uptime (Days)</th>
                                            <td>{{ $redisDetails['uptime_days'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Uptime (Seconds)</th>
                                            <td>{{ $redisDetails['uptime_seconds'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Used Memory</th>
                                            <td>{{ $redisDetails['used_memory'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Connected Clients</th>
                                            <td>{{ $redisDetails['connected_clients'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Commands Processed</th>
                                            <td>{{ $redisDetails['total_commands_processed'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Connections Received</th>
                                            <td>{{ $redisDetails['total_connections'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Expired Keys</th>
                                            <td>{{ $redisDetails['expired_keys'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Evicted Keys</th>
                                            <td>{{ $redisDetails['evicted_keys'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>CPU Usage</th>
                                            <td>{{ $redisDetails['cpu_usage'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="col-md-6 flex-fill">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Redis Connection Details</div>
                        </div>
                        <div class="card-body">
                            <div class="card-text table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        @foreach ($redisDetails['redis_connection'] as $key => $value)
                                            @if ($key !== 'password') 
                                                <tr>
                                                    <th>{{ ucfirst($key) }}</th>
                                                    <td>{{ $value ?: 'N/A' }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row d-flex mb-3">
                <div class="col-md-6 flex-fill">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title">Redis Keys</div>
                            <div>
                                <input type="text" id="search_keys" class="form-control form-control-sm" placeholder="Search Keys"/>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text table-responsive">
                                @if($redisDetails['keyDetails'])
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Key</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Size (Bytes)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($redisDetails['keyDetails'] as $index => $key)
                                                <tr class="clickable-row key-row" data-key="{{$key['key']}}" data-value="{{ $key['value'] }}">
                                                    <td>
                                                        <span class="key-text" style="display: none">{{ $key['key'] }}</span>
                                                        <span title="{{ $key['key'] }}" style="color: #12126f !important;">
                                                            {{ strlen($key['key']) > 60 ? substr($key['key'], 0, 60) . '...' : $key['key'] }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $key['type'] }}</td>
                                                    <td>{{ $key['size'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div style="display: flex; justify-content: center; align-items: center;">
                                        No Data Found
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="offcanvas offcanvas-end" tabindex="-1" id="keyOffcanvas">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasTitle">Key Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <p><strong>Key:</strong> <span id="offcanvasKey"></span></p>
                        <p><strong>Value:</strong></p>
                        <pre id="offcanvasValue" class="word-wrap text-break" style="white-space: pre-wrap !important;"></pre>
                    </div>
                </div>
            </div>
        @else
            <div style="max-width: 600px; margin: 30px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background: #f9f9f9; text-align: center; font-family: Arial, sans-serif; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                <h2 style="color: {{ $redisInstalled ? '#27ae60' : '#d63031' }}; margin-bottom: 10px;">{{ $header }}</h2>
                <p style="color: #555; font-size: 16px; margin-bottom: 15px;">
                    {{$message}}
                </p>

                <hr style="border: 1px solid #ddd; margin: 15px 0;">
                <p style="color: #444; font-size: 15px; font-weight: bold; background: #fffae6; padding: 8px; border-radius: 5px; display: inline-block;">
                    🚀 Looking for more useful Laravel packages?
                </p>

                <a href="https://packagist.org/packages/itpathsolutions/" target="_blank" 
                    style="display: inline-block; padding: 8px 12px; background: linear-gradient(135deg, #007bff, #0056b3); 
                            color: #fff; text-decoration: none; font-weight: 600; border-radius: 5px; 
                            font-size: 14px; transition: all 0.3s ease-in-out; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                    🔗 Explore Laravel Packages
                </a>
            </div>
        @endif
    </div>
@endif

@endsection
@section('redisinfo::script')
<script>
    document.addEventListener("DOMContentLoaded", function() {

        document.querySelectorAll(".clickable-row").forEach(row => {
            row.addEventListener("click", function() {
                let key = this.getAttribute("data-key");
                let value = this.getAttribute("data-value");

                document.getElementById("offcanvasKey").textContent = key;
                document.getElementById("offcanvasValue").textContent = value;

                let offcanvas = new bootstrap.Offcanvas(document.getElementById("keyOffcanvas"));
                offcanvas.show();
            });
        });

        document.getElementById('search_keys').addEventListener('keyup', function() {
        let searchText = this.value.toLowerCase();
        let rows = document.querySelectorAll('.key-row');

            rows.forEach(row => {
                let keyTextElement = row.querySelector('.key-text');
                if (keyTextElement) {
                    let keyName = keyTextElement.textContent.toLowerCase();
                    if (keyName.includes(searchText)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });
    });
</script>
@endsection