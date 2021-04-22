@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-10 offset-1 mt-3">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Liste des agences</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Contact</th>
                        <th>E-mail</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-danger">55%</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection
