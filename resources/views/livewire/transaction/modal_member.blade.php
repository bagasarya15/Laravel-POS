<!-- Modal -->
<div class="modal fade" id="exampleModalMember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 130%">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="card">
            <div class="table-responsive">
              <table class="table table-multiple table-hover">
                  <thead class="small">
                      <tr class="small">
                          <th>#</th>
                          <th>Kode Member</th>
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th>No Tlp</th>
                          <th>Status</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($member as $member)
                      <tr class="small">
                          <td>{{ $loop->iteration }}</td>
                          <td><span class="badge bg-primary text-light">{{ $member->code_member }}</span></td>
                          <td>{{ $member->name }}</td>
                          <td>{{ $member->address }}</td>
                          <td>{{ $member->number_phone }}</td>
                          <td>{{ $member->member_status }}</td>
                          <td>
                            <div class="d-flex">
                                <form action="{{ route('transaction.add-member') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="member_id" value="{{ $member->id }}" >
                                    <button type="submit" class="btn btn-sm btn-primary"> <i class="fas fa-plus"></i></button>
                                </form>
                            </div>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>