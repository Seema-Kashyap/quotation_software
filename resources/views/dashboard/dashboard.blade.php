@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')


   <!-- dashboard inner -->
   <div class="midde_cont">
      <div class="container-fluid px-0">
         <div class="row column_title">
            <div class="col-md-12">
               <div class="content-header">
                  <a href="#" class="theme-btn-dark">Create Quotation</a>
               </div>
            </div>
         </div>

         <div class="midde_cont">
            <div class="container-fluid">
               <!-- row -->
               <div class="row row-1">
                  <div class="col-lg-4 column-1">
                     <div class="white_shd full margin_bottom_30">
                        <div class="map_section padding_infor_info">
                           <div class="chart-box">

                              <canvas id="bar_chart" class="app_url" data-api-url="{{ route('dashboard.getgraphData') }}"></canvas>
                           </div>
                        </div>
                        <div class="full graph_head">
                           <div class="heading1 margin_0">
                              <h2>Statistic of current month</h2>
                           </div>
                        </div>
                        <div class="full graph_subhead">
                           <div class="heading2 margin_0">
                              <h4>Number of Quotation</h4>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 pr-lg-5 column-2">
                     <div class="white_shd full margin_bottom_30 p-25">
                        <div class="full progress_bar_inner">
                           <div class="row">
                              <div class="col-md-9">
                                 <div class="full">
                                    <div class="padding_infor_info p-0">
                                       <h4>Total Create Quotation</h4>
                                       @if(isset($graphData['create']))
                                          <h3> {{ $graphData['create'] }}</h3>
                                       @else

                                       @endif

                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="full">
                                    <div class="padding_infor_info p-0">
                                       <a href="{{route('createquotation.csv')}}"><img class="img-responsive" src="{{asset('assets/fonts/download.svg')}}" alt="" /></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="white_shd full margin_bottom_30 p-25">
                        <div class="full progress_bar_inner">
                           <div class="row">
                              <div class="col-md-9">
                                 <div class="full">
                                    <div class="padding_infor_info p-0">
                                       <h4>Total Open Quotation</h4>
                                       @if(isset($graphData['open']))
                                          <h3> {{ $graphData['open'] }}</h3>
                                       @else

                                       @endif
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="full">
                                    <div class="padding_infor_info p-0">
                                       <a href="{{route('openquotation.csv')}}"><img class="img-responsive" src="{{asset('assets/fonts/download.svg')}}" alt="" /></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="white_shd full margin_bottom_30 p-25">
                        <div class="full progress_bar_inner">
                           <div class="row">
                              <div class="col-md-9">
                                 <div class="full">
                                    <div class="padding_infor_info p-0">
                                       <h4>Total Won Quotation</h4>
                                       @if(isset($graphData['won']))
                                          <h3> {{ $graphData['won'] }}</h3>
                                       @else

                                       @endif
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="full">
                                    <div class="padding_infor_info p-0">
                                       <a href="{{route('wonquotation.csv')}}"><img class="img-responsive" src="{{asset('assets/fonts/download.svg')}}" alt="" /></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="white_shd full margin_bottom_30 p-25">
                        <div class="full progress_bar_inner">
                           <div class="row">
                              <div class="col-md-9">
                                 <div class="full">
                                    <div class="padding_infor_info p-0">
                                       <h4>Total Lost Quotation</h4>
                                       @if(isset($graphData['lost']))
                                          <h3> {{ $graphData['lost'] }}</h3>
                                       @else

                                       @endif
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="full">
                                    <div class="padding_infor_info p-0">
                                       <a href="{{route('lostquotation.csv')}}"><img class="img-responsive" src="{{asset('assets/fonts/download.svg')}}" alt="" /></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 earning-company-col column-3">
                     <div class="white_shd full margin_bottom_30 p-25">
                        <div class="full progress_bar_inner">
                           <div class="row">
                              <div class="col-md-9">
                                 <div class="full">
                                    <div class="padding_infor_info p-0">
                                       <h4>Earning By company</h4>
                                       @if(isset($graphData['totalEarnComp']))
                                          <h3> {{ $graphData['totalEarnComp'] }}</h3>
                                       @else

                                       @endif
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="full">
                                    <div class="padding_infor_info p-0">
                                       <a href="#"><img class="img-responsive" src="{{asset('assets/fonts/award.svg')}}" alt="" /></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="white_shd full margin_bottom_30 p-25">
                        <div class="full progress_bar_inner">
                           <div class="row">
                              <div class="col-md-9">
                                 <div class="full">
                                    <div class="padding_infor_info p-0">
                                       <h4>Earning By Items</h4>
                                       @if(isset($graphData['totalEarnItems']))
                                          <h3> {{ $graphData['totalEarnItems'] }}</h3>
                                       @else

                                       @endif
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="full">
                                    <div class="padding_infor_info p-0">
                                       <a href="#"><img class="img-responsive" src="{{asset('assets/fonts/award.svg')}}" alt="" /></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>



               </div>
               <!-- end row -->
            </div>

         </div>
      </div>
      <!-- end dashboard inner -->
   </div>
<!-- </div> -->
@endsection
