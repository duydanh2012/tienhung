@extends('admin.layouts.index')
@section('title', $title)
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">{{ $title }}</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="table-search-form row gx-1 align-items-center" action="{{ route('categories.search') }}" method="POST">
                                    @csrf
                                    <div class="col-auto">
                                        <input type="text" id="search-orders" name="q"
                                            class="form-control search-orders" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>

                            </div>
                            <!--//col-->
                            {{-- <div class="col-auto">

                                <select class="form-select w-auto">
                                    <option selected value="option-1">All</option>
                                    <option value="option-2">This week</option>
                                    <option value="option-3">This month</option>
                                    <option value="option-4">Last 3 months</option>

                                </select>
                            </div> --}}
                            <div class="col-auto">
                                <a class="btn app-btn-secondary" href="{{ route('categories.create') }}">
                                    <svg width="1em" height="1em" class="bi bi-download me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                                    </svg>
                                    Th??m m???i
                                </a>
                            </div>
                        </div>
                        <!--//row-->
                    </div>
                    <!--//table-utilities-->
                </div>
                <!--//col-auto-->
            </div>
            <!--//row-->
            @if (session('alert_success'))
                <div class="alert alert-success">
                    {{session('alert_success')}}
                </div>
            @endif
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                    aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">ID</th>
                                            <th class="cell">T??n danh m???c</th>
                                            <th class="cell">Danh m???c cha</th>
                                            <th class="cell">Ng??y t???o</th>
                                            <th class="cell">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($categories->count() > 0)
                                            @foreach ($categories as $item)
                                                <tr>
                                                    <td class="cell">{{ $item->id }}</td>
                                                    <td class="cell"><a href="{{ route('categories.edit', $item->id) }}"><span class="truncate">{{ $item->name }}</span></a></td>
                                                    <td class="cell"><a href="{{ ($item->parent->id) ? route('categories.edit', $item->parent->id) : NULL}}"><span class="truncate">{{ $item->parent->name }}</span></a></td>
                                                    <td class="cell">{{ date("d-m-Y", strtotime($item->created_at) ) }}</td>
                                                    <td class="cell">
                                                        <a class="btn-sm app-btn-secondary" href="{{ route('categories.edit', $item->id) }}">S???a</a>
                                                        <button type="button" data-href="{{ route('categories.destroy', $item->id) }}" class="btn-sm app-btn-primary btn-delete" data-toggle="modal" data-target="#exampleModal">X??a</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="cell text-center" colspan="4">Kh??ng c?? d??? li???u</td>
                                            </tr>
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!--//table-responsive-->

                        </div>
                        <!--//app-card-body-->
                    </div>

                    {{ $categories->links('layouts.paginator') }}
                    <!--//app-pagination-->

                </div>
                <!--//tab-pane-->
            </div>
            <!--//tab-content-->



        </div>
        <!--//container-fluid-->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">X??a</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              B???n c?? ch???c ch???n mu???n x??a kh??ng?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">????ng</button>
              <form action="" class="delete-confirm" method="POST">
                  @method('DELETE')
                  @csrf
                <button type="submit" class="btn btn-primary" >X??a</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <script>
        $(document).ready(function(){
            setTimeout(function() {
                $(".alert-success").hide()
            }, 5000);

            $(document).on('click', '.btn-delete', function(){
                let href = $(this).attr('data-href');
                $(".delete-confirm").attr("action", href);
            });
        })
    </script>
@endsection