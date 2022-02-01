@extends('layouts.app')

@section('content')

<!--- Header Start ---->
@include('web/partials/header')

<div class="api-area">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card p-5">
                <div class="center-big-content-block">
                    <h2 class="mb-3">API</h2>
                    <div class="table-bg">
                        <div class="table-wr ">
                            <table class="table mb-3">
                                <tbody>
                                    <tr>
                                        <td class="width-40">HTTP Method</td>
                                        <td>POST</td>
                                    </tr>
                                    <tr>
                                        <td>API URL</td>
                                        <td>https://smdaddy.com/api/v2</td>
                                    </tr>
                                    <tr>
                                        <td>Response format</td>
                                        <td>JSON</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <h4 class="mb-3">Service list</h4>
                    <div class="table-bg">
                        <div class="table-wr ">
                            <table class="table mb-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="width-40">Parameters</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>key</td>
                                        <td>Your API key</td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>services</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h6>Example response</h6>
                    </div>
                    <pre>[
      {
          "service": 1,
          "name": "Followers",
          "type": "Default",
          "category": "First Category",
          "rate": "0.90",
          "min": "50",
          "max": "10000",
          "refill": true
      },
      {
          "service": 2,
          "name": "Comments",
          "type": "Custom Comments",
          "category": "Second Category",
          "rate": "8",
          "min": "10",
          "max": "1500",
          "refill": false
      }
  ]
  </pre>
                    <h4 class="mb-3">Add order</h4>
                    <form class="">
                        <div class="form-group">
                            <select class="form-control input-sm" id="service_type">
                                <option value="0">Default</option>
                                <option value="10">Package</option>
                            </select>
                        </div>
                    </form>
                    <div id="type_0" style="">
                        <div class="table-bg">
                            <div class="table-wr ">
                                <table class="table mb-3">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="width-40">Parameters</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>key</td>
                                            <td>Your API key</td>
                                        </tr>
                                        <tr>
                                            <td>action</td>
                                            <td>add</td>
                                        </tr>
                                        <tr>
                                            <td>service</td>
                                            <td>Service ID</td>
                                        </tr>
                                        <tr>
                                            <td>link</td>
                                            <td>Link to page</td>
                                        </tr>
                                        <tr>
                                            <td>quantity</td>
                                            <td>Needed quantity</td>
                                        </tr>
                                        <tr>
                                            <td>runs (optional)</td>
                                            <td>Runs to deliver</td>
                                        </tr>
                                        <tr>
                                            <td>interval (optional)</td>
                                            <td>Interval in minutes</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="type_10" style="display:none;">
                        <div class="table-bg">
                            <div class="table-wr ">
                                <table class="table mb-3">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="width-40">Parameters</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>key</td>
                                            <td>Your API key</td>
                                        </tr>
                                        <tr>
                                            <td>action</td>
                                            <td>add</td>
                                        </tr>
                                        <tr>
                                            <td>service</td>
                                            <td>Service ID</td>
                                        </tr>
                                        <tr>
                                            <td>link</td>
                                            <td>Link to page</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6>Example response</h6>
                    </div>
                    <pre>{
      "order": 23501
  }
  </pre>
                    <h4 class="mb-3">Order status</h4>
                    <div class="table-bg">
                        <div class="table-wr ">
                            <table class="table mb-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="width-40">Parameters</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>key</td>
                                        <td>Your API key</td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>status</td>
                                    </tr>
                                    <tr>
                                        <td>order</td>
                                        <td>Order ID</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h6>Example response</h6>
                    </div>
                    <pre>{
      "charge": "0.27819",
      "start_count": "3572",
      "status": "Partial",
      "remains": "157",
      "currency": "USD"
  }
  </pre>
                    <h4 class="mb-3">Multiple orders status</h4>
                    <div class="table-bg">
                        <div class="table-wr ">
                            <table class="table mb-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="width-40">Parameters</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>key</td>
                                        <td>Your API key</td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>status</td>
                                    </tr>
                                    <tr>
                                        <td>orders</td>
                                        <td>Order IDs separated by comma</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h6>Example response</h6>
                    </div>
                    <pre>{
      "1": {
          "charge": "0.27819",
          "start_count": "3572",
          "status": "Partial",
          "remains": "157",
          "currency": "USD"
      },
      "10": {
          "error": "Incorrect order ID"
      },
      "100": {
          "charge": "1.44219",
          "start_count": "234",
          "status": "In progress",
          "remains": "10",
          "currency": "USD"
      }
  }
  </pre>
                    <h4 class="mb-3">Create refill</h4>
                    <div class="table-bg">
                        <div class="table-wr ">
                            <table class="table mb-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="width-40">Parameters</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>key</td>
                                        <td>Your API key</td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>refill</td>
                                    </tr>
                                    <tr>
                                        <td>order</td>
                                        <td>Order ID</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h6>Example response</h6>
                    </div>
                    <pre>{
      "refill": "1"
  }
  </pre>
                    <h4 class="mb-3">Get refill status</h4>
                    <div class="table-bg">
                        <div class="table-wr ">
                            <table class="table mb-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="width-40">Parameters</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>key</td>
                                        <td>Your API key</td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>refill_status</td>
                                    </tr>
                                    <tr>
                                        <td>refill</td>
                                        <td>Refill ID</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h6>Example response</h6>
                    </div>
                    <pre>{
      "status": "Completed"
  }
  </pre>
                    <h4 class="mb-3">User balance</h4>
                    <div class="table-bg">
                        <div class="table-wr ">
                            <table class="table mb-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="width-40">Parameters</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>key</td>
                                        <td>Your API key</td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>balance</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h6>Example response</h6>
                    </div>
                    <pre>{
      "balance": "100.84292",
      "currency": "USD"
  }
  </pre>
                    <a href="/example.txt" class="btn btn-big-secondary" target="_blank">Example of PHP code</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ***** Footer Start ***** -->
@include('web/partials/footer')


@endsection

@section('scripts')
<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>
<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/js/imgfix.min.js') }}"></script>

<!-- Global Init -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
