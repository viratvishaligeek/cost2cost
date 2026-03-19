@extends('backend.include.layout')
@section('css')
    <link href="{{ URL::asset('backend') }}/leaflet/leaflet.css" rel="stylesheet">
    <link href="{{ URL::asset('backend') }}/leaflet.markercluster/MarkerCluster.css" rel="stylesheet">
    <link href="{{ URL::asset('backend') }}/leaflet.markercluster/MarkerCluster.Default.css" rel="stylesheet">
@endsection
@section('content')
    <div class="pb-5">
        <div class="row g-4">
            <div class="col-12 col-xxl-6">
                <div class="mb-8">
                    <h2 class="mb-2">Ecommerce Dashboard</h2>
                    <h5 class="text-body-tertiary fw-semibold">Here’s what’s going on at your business right now</h5>
                </div>
                <div class="row align-items-center g-4">
                    <div class="col-12 col-md-auto">
                        <div class="d-flex align-items-center">
                            <span class="fa-stack" style="min-height: 46px;min-width: 46px;">
                                <span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-success-light"
                                    data-fa-transform="down-4 rotate--10 left-4">
                                </span>
                                <span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-success"
                                    data-fa-transform="up-4 right-3 grow-2">
                                </span>
                                <span class="fa-stack-1x fa-solid fa-star text-success "
                                    data-fa-transform="shrink-2 up-8 right-6">
                                </span>
                            </span>
                            <div class="ms-3">
                                <h4 class="mb-0">57 new orders</h4>
                                <p class="text-body-secondary fs-9 mb-0">Awating processing</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="d-flex align-items-center">
                            <span class="fa-stack" style="min-height: 46px;min-width: 46px;">
                                <span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-warning-light"
                                    data-fa-transform="down-4 rotate--10 left-4">
                                </span>
                                <span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-warning"
                                    data-fa-transform="up-4 right-3 grow-2">
                                </span>
                                <span class="fa-stack-1x fa-solid fa-pause text-warning "
                                    data-fa-transform="shrink-2 up-8 right-6">
                                </span>
                            </span>
                            <div class="ms-3">
                                <h4 class="mb-0">5 orders</h4>
                                <p class="text-body-secondary fs-9 mb-0">On hold</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="d-flex align-items-center">
                            <span class="fa-stack" style="min-height: 46px;min-width: 46px;">
                                <span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-danger-light"
                                    data-fa-transform="down-4 rotate--10 left-4">
                                </span>
                                <span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-danger"
                                    data-fa-transform="up-4 right-3 grow-2">
                                </span>
                                <span class="fa-stack-1x fa-solid fa-xmark text-danger "
                                    data-fa-transform="shrink-2 up-8 right-6">
                                </span>
                            </span>
                            <div class="ms-3">
                                <h4 class="mb-0">15 products</h4>
                                <p class="text-body-secondary fs-9 mb-0">Out of stock</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="bg-body-secondary mb-6 mt-4" />
                <div class="row flex-between-center mb-4 g-3">
                    <div class="col-auto">
                        <h3>Total sells</h3>
                        <p class="text-body-tertiary lh-sm mb-0">Payment received across all channels</p>
                    </div>
                    <div class="col-8 col-sm-4">
                        <select class="form-select form-select-sm" id="select-gross-revenue-month">
                            <option>Mar 1 - 31, 2022</option>
                            <option>April 1 - 30, 2022</option>
                            <option>May 1 - 31, 2022</option>
                        </select>
                    </div>
                </div>
                <div class="echart-total-sales-chart" style="min-height:320px;width:100%">
                </div>
            </div>
            <div class="col-12 col-xxl-6">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-1">Total orders<span
                                                class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2">
                                                <span class="badge-label">-6.8%</span>
                                            </span>
                                        </h5>
                                        <h6 class="text-body-tertiary">Last 7 days</h6>
                                    </div>
                                    <h4>16,247</h4>
                                </div>
                                <div class="d-flex justify-content-center px-4 py-6">
                                    <div class="echart-total-orders" style="height:85px;width:115px">
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bullet-item bg-primary me-2">
                                        </div>
                                        <h6 class="text-body fw-semibold flex-1 mb-0">Completed</h6>
                                        <h6 class="text-body fw-semibold mb-0">52%</h6>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="bullet-item bg-primary-subtle me-2">
                                        </div>
                                        <h6 class="text-body fw-semibold flex-1 mb-0">Pending payment</h6>
                                        <h6 class="text-body fw-semibold mb-0">48%</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-1">New customers<span
                                                class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2">
                                                <span class="badge-label">+26.5%</span>
                                            </span>
                                        </h5>
                                        <h6 class="text-body-tertiary">Last 7 days</h6>
                                    </div>
                                    <h4>356</h4>
                                </div>
                                <div class="pb-0 pt-4">
                                    <div class="echarts-new-customers" style="height:180px;width:100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-2">Top coupons</h5>
                                        <h6 class="text-body-tertiary">Last 7 days</h6>
                                    </div>
                                </div>
                                <div class="pb-4 pt-3">
                                    <div class="echart-top-coupons" style="height:115px;width:100%;">
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bullet-item bg-primary me-2">
                                        </div>
                                        <h6 class="text-body fw-semibold flex-1 mb-0">Percentage discount</h6>
                                        <h6 class="text-body fw-semibold mb-0">72%</h6>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bullet-item bg-primary-lighter me-2">
                                        </div>
                                        <h6 class="text-body fw-semibold flex-1 mb-0">Fixed card discount</h6>
                                        <h6 class="text-body fw-semibold mb-0">18%</h6>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="bullet-item bg-info-dark me-2">
                                        </div>
                                        <h6 class="text-body fw-semibold flex-1 mb-0">Fixed product discount</h6>
                                        <h6 class="text-body fw-semibold mb-0">10%</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-2">Paying vs non paying</h5>
                                        <h6 class="text-body-tertiary">Last 7 days</h6>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center pt-3 flex-1">
                                    <div class="echarts-paying-customer-chart" style="height:100%;width:100%;">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bullet-item bg-primary me-2">
                                        </div>
                                        <h6 class="text-body fw-semibold flex-1 mb-0">Paying customer</h6>
                                        <h6 class="text-body fw-semibold mb-0">30%</h6>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="bullet-item bg-primary-subtle me-2">
                                        </div>
                                        <h6 class="text-body fw-semibold flex-1 mb-0">Non-paying customer</h6>
                                        <h6 class="text-body fw-semibold mb-0">70%</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-7 border-y">
        <div data-list='{"valueNames":["product","customer","rating","review","time"],"page":6}'>
            <div class="row align-items-end justify-content-between pb-5 g-3">
                <div class="col-auto">
                    <h3>Latest reviews</h3>
                    <p class="text-body-tertiary lh-sm mb-0">Payment received across all channels</p>
                </div>
                <div class="col-12 col-md-auto">
                    <div class="row g-2 gy-3">
                        <div class="col-auto flex-1">
                            <div class="search-box">
                                <form class="position-relative">
                                    <input class="form-control search-input search form-control-sm" type="search"
                                        placeholder="Search" aria-label="Search" />
                                    <span class="fas fa-search search-box-icon">
                                    </span>
                                </form>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm btn-phoenix-secondary bg-body-emphasis bg-body-hover me-2"
                                type="button">All products</button>
                            <button class="btn btn-sm btn-phoenix-secondary bg-body-emphasis bg-body-hover action-btn"
                                type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true"
                                aria-expanded="false" data-bs-reference="parent">
                                <span class="fas fa-ellipsis-h" data-fa-transform="shrink-2">
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="index.html#">Action</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.html#">Another action</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.html#">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive mx-n1 px-1 scrollbar">
                <table class="table fs-9 mb-0 border-top border-translucent">
                    <thead>
                        <tr>
                            <th class="white-space-nowrap fs-9 ps-0 align-middle">
                                <div class="form-check mb-0 fs-8">
                                    <input class="form-check-input" id="checkbox-bulk-reviews-select" type="checkbox"
                                        data-bulk-select='{"body":"table-latest-review-body"}' />
                                </div>
                            </th>
                            <th class="sort white-space-nowrap align-middle" scope="col">
                            </th>
                            <th class="sort white-space-nowrap align-middle" scope="col" style="min-width:360px;"
                                data-sort="product">PRODUCT</th>
                            <th class="sort align-middle" scope="col" data-sort="customer" style="min-width:200px;">
                                CUSTOMER</th>
                            <th class="sort align-middle" scope="col" data-sort="rating" style="min-width:110px;">
                                RATING</th>
                            <th class="sort align-middle" scope="col" style="max-width:350px;" data-sort="review">
                                REVIEW</th>
                            <th class="sort text-start ps-5 align-middle" scope="col" data-sort="status">STATUS</th>
                            <th class="sort text-end align-middle" scope="col" data-sort="time">TIME</th>
                            <th class="sort text-end pe-0 align-middle" scope="col">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list" id="table-latest-review-body">
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8">
                                    <input class="form-check-input" type="checkbox"
                                        data-bulk-select-row='{"product":"Fitbit Sense Advanced Smartwatch with Tools for Heart Health, Stress Management & Skin Temperature Trends, Carbon/Graphite, One Size (S & L Bands)","productImage":"/products/60x60/1.png","customer":{"name":"Richard Dawkins","avatar":""},"rating":5,"review":"This Fitbit is fantastic! I was trying to be in better shape and needed some motivation, so I decided to treat myself to a new Fitbit.","status":{"title":"Approved","badge":"success","icon":"check"},"time":"Just now"}' />
                                </div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0">
                                <a class="d-block rounded-2 border border-translucent"
                                    href="apps/e-commerce/landing/product-details.html">
                                    <img src="{{ URL::asset('backend') }}/img/products/60x60/1.png" alt=""
                                        width="53" />
                                </a>
                            </td>
                            <td class="align-middle product white-space-nowrap">
                                <a class="fw-semibold" href="apps/e-commerce/landing/product-details.html">Fitbit Sense
                                    Advanced Smartwatch
                                    with Tools fo...</a>
                            </td>
                            <td class="align-middle customer white-space-nowrap">
                                <a class="d-flex align-items-center text-body"
                                    href="apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l">
                                        <div class="avatar-name rounded-circle">
                                            <span>R</span>
                                        </div>
                                    </div>
                                    <h6 class="mb-0 ms-3 text-body">Richard Dawkins</h6>
                                </a>
                            </td>
                            <td class="align-middle rating white-space-nowrap fs-10">
                                <span class="fa fa-star text-warning">
                                </span>
                                <span class="fa fa-star text-warning">
                                </span>
                                <span class="fa fa-star text-warning">
                                </span>
                                <span class="fa fa-star text-warning">
                                </span>
                                <span class="fa fa-star text-warning">
                                </span>
                            </td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">This Fitbit is fantastic! I was trying
                                    to be in better shape and needed some motivation, so I decided to treat myself to a new
                                    Fitbit.</p>
                            </td>
                            <td class="align-middle text-start ps-5 status">
                                <span class="badge badge-phoenix fs-10 badge-phoenix-success">
                                    <span class="badge-label">Approved</span>
                                    <span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;">
                                    </span>
                                </span>
                            </td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Just now</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions">
                                        <button class="btn btn-sm btn-phoenix-secondary me-1 fs-10">
                                            <span class="fas fa-check">
                                            </span>
                                        </button>
                                        <button class="btn btn-sm btn-phoenix-secondary fs-10">
                                            <span class="fas fa-trash">
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
                                        type="button" data-bs-toggle="dropdown" data-boundary="window"
                                        aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                        <span class="fas fa-ellipsis-h fs-10">
                                        </span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                        <a class="dropdown-item" href="index.html#!">View</a>
                                        <a class="dropdown-item" href="index.html#!">Export</a>
                                        <div class="dropdown-divider">
                                        </div>
                                        <a class="dropdown-item text-danger" href="index.html#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row align-items-center py-1">
                <div class="pagination d-none">
                </div>
                <div class="col d-flex fs-9">
                    <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info">
                    </p>
                    <a class="fw-semibold" href="index.html#!" data-list-view="*">View all<span
                            class="fas fa-angle-right ms-1" data-fa-transform="down-1">
                        </span>
                    </a>
                    <a class="fw-semibold d-none" href="index.html#!" data-list-view="less">View Less</a>
                </div>
                <div class="col-auto d-flex">
                    <button class="btn btn-link px-1 me-1" type="button" title="Previous" data-list-pagination="prev">
                        <span class="fas fa-chevron-left me-2">
                        </span>Previous</button>
                    <button class="btn btn-link px-1 ms-1" type="button" title="Next"
                        data-list-pagination="next">Next<span class="fas fa-chevron-right ms-2">
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-6">
        <div class="col-12 col-xl-6">
            <div data-list='{"valueNames":["country","users","transactions","revenue","conv-rate"],"page":5}'>
                <div class="mb-5 mt-7">
                    <h3>Top regions by revenue</h3>
                    <p class="text-body-tertiary">Where you generated most of the revenue</p>
                </div>
                <div class="table-responsive scrollbar">
                    <table class="table fs-10 mb-0">
                        <thead>
                            <tr>
                                <th class="sort border-top border-translucent ps-0 align-middle" scope="col"
                                    data-sort="country" style="width:32%">COUNTRY</th>
                                <th class="sort border-top border-translucent align-middle" scope="col"
                                    data-sort="users" style="width:17%">USERS</th>
                                <th class="sort border-top border-translucent text-end align-middle" scope="col"
                                    data-sort="transactions" style="width:16%">TRANSACTIONS</th>
                                <th class="sort border-top border-translucent text-end align-middle" scope="col"
                                    data-sort="revenue" style="width:20%">REVENUE</th>
                                <th class="sort border-top border-translucent text-end pe-0 align-middle" scope="col"
                                    data-sort="conv-rate" style="width:17%">CONV. RATE</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                            </td>
                            <td class="align-middle py-4">
                                <h4 class="mb-0 fw-normal">377,620</h4>
                            </td>
                            <td class="align-middle text-end py-4">
                                <h4 class="mb-0 fw-normal">236</h4>
                            </td>
                            <td class="align-middle text-end py-4">
                                <h4 class="mb-0 fw-normal">$15,758</h4>
                            </td>
                            <td class="align-middle text-end py-4 pe-0">
                                <h4 class="mb-0 fw-normal">10.32%</h4>
                            </td>
                        </tr>
                        <tbody class="list" id="table-regions-by-revenue">
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">1. </h6>
                                        <a href="index.html#!">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ URL::asset('backend') }}/img/country/india.png"
                                                    alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">India</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">92896<span
                                            class="text-body-tertiary fw-semibold ms-2">(41.6%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">67<span class="text-body-tertiary fw-semibold ms-2">(34.3%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$7560<span
                                            class="text-body-tertiary fw-semibold ms-2">(36.9%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>14.01%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">2. </h6>
                                        <a href="index.html#!">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ URL::asset('backend') }}/img/country/china.png"
                                                    alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">China</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">50496<span
                                            class="text-body-tertiary fw-semibold ms-2">(32.8%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">54<span class="text-body-tertiary fw-semibold ms-2">(23.8%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$6532<span
                                            class="text-body-tertiary fw-semibold ms-2">(26.5%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>23.56%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">3. </h6>
                                        <a href="index.html#!">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ URL::asset('backend') }}/img/country/usa.png" alt=""
                                                    width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">USA</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">45679<span
                                            class="text-body-tertiary fw-semibold ms-2">(24.3%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">35<span class="text-body-tertiary fw-semibold ms-2">(19.7%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$5432<span
                                            class="text-body-tertiary fw-semibold ms-2">(16.9%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>10.23%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">4. </h6>
                                        <a href="index.html#!">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ URL::asset('backend') }}/img/country/south-korea.png"
                                                    alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">South Korea</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">36453<span
                                            class="text-body-tertiary fw-semibold ms-2">(19.7%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">22<span class="text-body-tertiary fw-semibold ms-2">(9.54%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$4673<span
                                            class="text-body-tertiary fw-semibold ms-2">(11.6%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>8.85%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">5. </h6>
                                        <a href="index.html#!">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ URL::asset('backend') }}/img/country/vietnam.png"
                                                    alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">Vietnam</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">15007<span
                                            class="text-body-tertiary fw-semibold ms-2">(11.9%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">17<span class="text-body-tertiary fw-semibold ms-2">(6.91%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$2456<span
                                            class="text-body-tertiary fw-semibold ms-2">(10.2%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>6.01%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">6. </h6>
                                        <a href="index.html#!">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ URL::asset('backend') }}/img/country/russia.png"
                                                    alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">Russia</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">54215<span
                                            class="text-body-tertiary fw-semibold ms-2">(32.9%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">38<span class="text-body-tertiary fw-semibold ms-2">(7.91%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$3254<span
                                            class="text-body-tertiary fw-semibold ms-2">(12.4%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>6.21%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">7. </h6>
                                        <a href="index.html#!">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ URL::asset('backend') }}/img/country/australia.png"
                                                    alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">Australia</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">54789<span
                                            class="text-body-tertiary fw-semibold ms-2">(12.7%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">32<span class="text-body-tertiary fw-semibold ms-2">(14.0%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$3215<span
                                            class="text-body-tertiary fw-semibold ms-2">(5.72%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>12.02%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">8. </h6>
                                        <a href="index.html#!">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ URL::asset('backend') }}/img/country/england.png"
                                                    alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">England</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">14785<span
                                            class="text-body-tertiary fw-semibold ms-2">(12.9%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">11<span class="text-body-tertiary fw-semibold ms-2">(32.91%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$4745<span
                                            class="text-body-tertiary fw-semibold ms-2">(10.2%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>8.01%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">9. </h6>
                                        <a href="index.html#!">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ URL::asset('backend') }}/img/country/indonesia.png"
                                                    alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">Indonesia</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">32156<span
                                            class="text-body-tertiary fw-semibold ms-2">(32.2%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">89<span class="text-body-tertiary fw-semibold ms-2">(12.0%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$2456<span
                                            class="text-body-tertiary fw-semibold ms-2">(23.2%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>9.07%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">10. </h6>
                                        <a href="index.html#!">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ URL::asset('backend') }}/img/country/japan.png"
                                                    alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">Japan</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">12547<span
                                            class="text-body-tertiary fw-semibold ms-2">(12.7%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">21<span class="text-body-tertiary fw-semibold ms-2">(14.91%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$2541<span
                                            class="text-body-tertiary fw-semibold ms-2">(23.2%)</span>
                                    </h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>20.01%</h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row align-items-center py-1">
                    <div class="pagination d-none">
                    </div>
                    <div class="col d-flex fs-9">
                        <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info">
                        </p>
                    </div>
                    <div class="col-auto d-flex">
                        <button class="btn btn-link px-1 me-1" type="button" title="Previous"
                            data-list-pagination="prev">
                            <span class="fas fa-chevron-left me-2">
                            </span>Previous</button>
                        <button class="btn btn-link px-1 ms-1" type="button" title="Next"
                            data-list-pagination="next">Next<span class="fas fa-chevron-right ms-2">
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="mx-n4 mx-lg-n6 ms-xl-0 h-100">
                <div class="h-100 w-100">
                    <div class="h-100 bg-body-emphasis" id="map" style="min-height: 300px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-6 pb-9 border-top">
        <div class="row g-6">
            <div class="col-12 col-xl-6">
                <div class="me-xl-4">
                    <div>
                        <h3>Projection vs actual</h3>
                        <p class="mb-1 text-body-tertiary">Actual earnings vs projected earnings</p>
                    </div>
                    <div class="echart-projection-actual" style="height:300px; width:100%">
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div>
                    <h3>Returning customer rate</h3>
                    <p class="mb-1 text-body-tertiary">Rate of customers returning to your shop over time</p>
                </div>
                <div class="echart-returning-customer" style="height:300px;">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('backend') }}/echarts/echarts.min.js"></script>
    <script src="{{ URL::asset('backend') }}/js/dashboards/ecommerce-dashboard.js"></script>
    <script src="{{ URL::asset('backend') }}/leaflet/leaflet.js"></script>
    <script src="{{ URL::asset('backend') }}/leaflet.markercluster/leaflet.markercluster.js"></script>
    <script src="{{ URL::asset('backend') }}/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js"></script>
@endsection
