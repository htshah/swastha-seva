@if(!in_array(Request::path(),['login']))
<header>
    <nav class="primary-color">
        <div class="container nav-wrapper">
            <a href="#" class="brand-logo">{{ config('app.name') }}</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/home">Home</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="row white secondary-navbar no-margin">
        <form id="filters-form">
            <div class="container">
                <div class="col s1 no-padding-left input-field">Filters</div>
                <div class="col s2 input-field small-margin">
                    <select class="browser-default" id="state" name="state">
                        <option value="*" selected>Any state</option>
                        @foreach (\App\Address::select('state')->distinct()->get() as $state)
                            @php
                                $state = $state['state'];
                            @endphp
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col s2 input-field small-margin">
                    <select class="browser-default" id="city" name="city">
                        <option value="*" selected>Any Cities</option>
                    </select>
                </div>

                <div class="col s2 input-field small-margin">
                    <label for="pincode">Pincode</label>
                    <input type="text" name="pincode">
                </div>

                <div class="col s2 input-field small-margin">
                    <select class="browser-default" id="gender" name="gender">
                        <option value="*" selected>Any Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col s2 input-field small-margin">
                    <select class="browser-default" id="disease" name="disease">
                        <option value="*" selected>Any Disease</option>
                        <option value="cancer">Cancer</option>
                        <option value="aids">AIDS</option>
                        <option value="malaria">Malaria</option>
                    </select>
                </div>
                <div class="col s1 input-field small-margin">
                    <a id="btn-filter-apply" class="btn primary-color white-text waves-effect waves-grey" style="height:43px;line-height:43px;">Apply</a>
                </div>
            </div>
        </form>
    </div>
</header>

@endif