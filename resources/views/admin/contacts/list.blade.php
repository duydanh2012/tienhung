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
                                <form class="table-search-form row gx-1 align-items-center" action="{{ route('contact.search') }}" method="POST">
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
                                            <th class="cell">Người gửi</th>
                                            <th class="cell">Tiêu đề</th>
                                            <th class="cell">Ngày tạo</th>
                                            <th class="cell">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($contacts->count() > 0)
                                            @foreach ($contacts as $item)
                                                <tr>
                                                    <td class="cell">{{ $item->id }}</td>
                                                    <td class="cell"><a href="{{ route('contact.edit', $item->id) }}"><span class="truncate">{{ $item->name }}</span></a></td>
                                                    <td class="cell"><span class="truncate">{{ $item->subject }}</span></td>
                                                    <td class="cell">{{ date("d-m-Y", strtotime($item->created_at) ) }}</td>
                                                    <td class="cell">
                                                        <a class="btn-sm app-btn-secondary " href="{{ route('contact.edit', $item->id) }}">@if($item->reply != NULL) Replied  @else Reply @endif</a>
                                                        <button type="button" data-href="{{ route('contact.destroy', $item->id) }}" class="btn-sm app-btn-primary btn-delete" data-toggle="modal" data-target="#exampleModal">Xóa</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="cell text-center" colspan="4">Không có dữ liệu</td>
                                            </tr>
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!--//table-responsive-->

                        </div>
                        <!--//app-card-body-->
                    </div>

                    {{ $contacts->links('layouts.paginator') }}
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
              <h5 class="modal-title" id="exampleModalLabel">Xóa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có chắc chắn muốn xóa không?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
              <form action="" class="delete-confirm" method="POST">
                  @method('DELETE')
                  @csrf
                <button type="submit" class="btn btn-primary" >Xóa</button>
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