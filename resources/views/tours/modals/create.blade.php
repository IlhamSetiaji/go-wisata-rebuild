<div class="modal modal-right large fade" id="createData" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create A New Tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('tours') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <input class="form-control" type="text" name="name" />
                                <span>TOUR NAME</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <select name="user_id" id="uer" class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <span>CHOOSE MANAGER</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                                <span>DESCRIPTION</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <input class="form-control" type="file" name="image" />
                                <span>TOUR IMAGE</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <select name="province" id="province" class="form-control">
                                    <option label="&nbsp;"></option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->nama }}</option>
                                    @endforeach
                                </select>
                                <span>CHOOSE PROVINCE</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <select name="district" id="district" class="form-control">
                                    <option label="&nbsp;"></option>
                                </select>
                                <span>CHOOSE DISTRICT</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <select name="sub_district" id="sub_district" class="form-control">
                                    <option label="&nbsp;"></option>
                                </select>
                                <span>CHOOSE SUB-DISTRICT</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-3 top-label">
                                <select name="village" id="village" class="form-control">
                                    <option label="&nbsp;"></option>
                                </select>
                                <span>CHOOSE VILLAGE</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" id="lat" name="latitude"
                                    placeholder="Masukkan Koordinat Latitude" class="form-control" autofocus
                                    data-parsley-required="true">
                                {{-- value="{{{ $data->latitude ?? old('latitude') }}}" --}}
                                <input type="text" id="lng" name="longitude"
                                    placeholder="Masukkan Koordinat Longitude" class="form-control" autofocus
                                    data-parsley-required="true">
                                {{-- value="{{{ $data->longitude ?? old('longitude') }}}" --}}
                            </div>
                            <div class="container">
                                <div class="container" id="map" style="width: 100%; height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#createData').on('show.bs.modal', function(e) {
            setTimeout(test, 1000);
        });

        function test() {
            navigator.geolocation.getCurrentPosition(showMap);
        }

        function showMap(position) {
            let map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 13);
            let tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            marker = new L.marker([position.coords.latitude, position.coords.longitude], {
                draggable: 'true'
            });
            marker.on('dragend', function(event) {
                let marker = event.target;
                let position = marker.getLatLng();
                marker.setLatLng(new L.LatLng(position.lat, position.lng), {
                    draggable: 'true'
                });
                map.
                panTo(new L.LatLng(position.lat, position.lng))
                $("#lat").val(position.lat);
                $("#lng").val(position.lng);
            });
            map.addLayer(marker);
        }

        $(document).ready(function() {

            /*------------------------------------------
            --------------------------------------------
            Province dropdown change event
            --------------------------------------------
            --------------------------------------------*/
            $('#province').on('change', function() {
                var idProvince = this.value;
                $("#district").html('');
                $.ajax({
                    url: "{{ url('api/fetch-districts') }}",
                    type: "POST",
                    data: {
                        province_id: idProvince,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        $('#district').html(
                            '<option value="">-- Select State --</option>');
                        $.each(result, function(key, value) {
                            $("#district").append('<option value="' + value
                                .id + '">' + value.nama + '</option>');
                        });
                        $('#sub-district').html('<option value="">-- Select City --</option>');
                    }
                });
            });

            /*------------------------------------------
            --------------------------------------------
            District Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#district').on('change', function() {
                var idDistrict = this.value;
                $("#sub_district").html('');
                $.ajax({
                    url: "{{ url('api/fetch-sub-districts') }}",
                    type: "POST",
                    data: {
                        district_id: idDistrict,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        $('#sub_district').html(
                            '<option value="">-- Select State --</option>');
                        $.each(result, function(key, value) {
                            $("#sub_district").append('<option value="' + value
                                .id + '">' + value.nama + '</option>');
                        });
                        $('#village').html('<option value="">-- Select City --</option>');
                    }
                });
            });

            /*------------------------------------------
            --------------------------------------------
            Sub-District Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#sub_district').on('change', function() {
                var idSubDistrict = this.value;
                $("#village").html('');
                $.ajax({
                    url: "{{ url('api/fetch-villages') }}",
                    type: "POST",
                    data: {
                        sub_district_id: idSubDistrict,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        $('#village').html(
                            '<option value="">-- Select State --</option>');
                        $.each(result, function(key, value) {
                            $("#village").append('<option value="' + value
                                .id + '">' + value.nama + '</option>');
                        });
                        // $('#village').html('<option value="">-- Select City --</option>');
                    }
                });
            });

        });
    </script>
@endpush
