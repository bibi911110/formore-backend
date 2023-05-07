         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Date</th>
                      <th class="text-center">Time</th>
                      <th class="text-center">Order Code</th>
                      <th class="text-center">Member Name</th>
                      <th class="text-center">Action</th>
                      
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                  @foreach ($data as $key => $sub_categories)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{Carbon\Carbon::parse($sub_categories->created_at)->format('Y-m-d')}}</td>
                      <td class="text-center">{{ Carbon\Carbon::parse($sub_categories->created_at)->format('H:i:s A') }}</td>
                      <td class="text-center">{{ $sub_categories->order_id }}</td>
                      <td class="text-center">{{ $sub_categories->member_name }}</td>
                      <td class="text-center"><a href="{{url('view_order_details').'/'.$sub_categories->id}}">Details</a></td>
                    </tr>
                  @endforeach
                                
              </tbody>
          </table>