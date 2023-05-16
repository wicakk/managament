@extends('profiles.layout')
@section('content')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div
                                    class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                                    <h5>User</h5>
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="list-grid-toggle d-flex align-items-center mr-3">
                                            <div data-toggle-extra="tab" data-target-extra="#grid" class="active">
                                                <div class="grid-icon mr-3">
                                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <rect x="3" y="3" width="7" height="7"></rect>
                                                        <rect x="14" y="3" width="7" height="7"></rect>
                                                        <rect x="14" y="14" width="7" height="7"></rect>
                                                        <rect x="3" y="14" width="7" height="7"></rect>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div data-toggle-extra="tab" data-target-extra="#list">
                                                <div class="grid-icon">
                                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <line x1="21" y1="10" x2="3" y2="10"></line>
                                                        <line x1="21" y1="6" x2="3" y2="6"></line>
                                                        <line x1="21" y1="14" x2="3" y2="14"></line>
                                                        <line x1="21" y1="18" x2="3" y2="18"></line>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pl-3 border-left btn-new">
                                            <a href="#" class="btn btn-primary" data-target="#new-project-modal"
                                                data-toggle="modal">Add User</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="grid" class="item-content animate__animated animate__fadeIn active"
                    data-toggle-extra="tab-content">
                    <div class="row">
                    @foreach($profiles as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <h5 class="mb-1">{{ $item->username }}</h5>
                                    <p class="mb-3">{{ $item->email }}</p>
                                    <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                        <div class="iq-media-group">
                                            <span href="#" class="iq-media">
                                                <img class="img-fluid avatar-40 rounded-circle"
                                                    src="../assets/images/user/05.jpg" alt="">
                                                <a class="btn btn-white text-primary">{{ $item->role }}</a>
                                            </span>
                                        </div>
                                        <span>
                                            <form method="POST" action="{{ url('/profiles' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <a  class="btn btn-white text-primary link-shadow bg-danger "  title="Delete Student" type="submit" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                </svg>
                                            </a>
                                            </form>
                                            <a href="{{ url('/profiles/' . $item->id . '/edit') }}" title="Edit Student" type="submit" class="btn btn-white text-primary link-shadow bg-warning text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach    
                    </div>
                </div>
                <div id="list" class="item-content animate__animated animate__fadeIn" data-toggle-extra="tab-content">
                    <div class="row">
                    @foreach($profiles as $item)
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="d-flex align-items-center">
                                                <div class="ml-3">
                                                    <h5 class="mb-1">{{ $item->username }}</h5>
                                                    <p class="mb-0">{{ $item->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                            <div class="iq-media-group">
                                                <a href="#" class="iq-media">
                                                    <img class="img-fluid avatar-40 rounded-circle"
                                                        src="../assets/images/user/05.jpg" alt="">
                                                </a>
                                            </div>
                                            <span>
                                            <a class="btn btn-white text-primary link-shadow bg-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                </svg>
                                            </a>
                                            <a class="btn btn-white text-primary link-shadow bg-warning text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </a>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach 
                    </div>
                </div>
                <!-- Page end  -->
@endsection