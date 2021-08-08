@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Bulk Product Upload</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form class="form" action="{{ route('csv_to_show_info') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="first-name-column">Products CSV</label>
                                    <input type="file" id="first-name-column" class="form-control" name="csvFile" required />
                                </div>

                                <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>

                        </div>
                        <div class="col-md-6">
                        <a class="btn btn btn-info btn-lg btn-block" href="media/demo-product-csv.csv">Product Demo CSV Download</a> <br/>
                        <a class="btn btn btn-warning btn-lg btn-block" href="all-product-export.php">Existing all Product CSV Download</a> <br/>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
