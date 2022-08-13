<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css')}}">
</head>
<body>
    <div style="height: 50px; widows: 100%; text-align: center">
        {{-- Show success message --}}
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        {{-- Show success message --}}
        @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
        @endif
    </div>
    <div class="row">
    <div class="col-md-4" style="margin-top: 20px;"> 
        <h5 style="text-align: center">Enter transaction details</h5>
        {{-- submit form data to the store function as defined in the route --}}
        <form class="container w-75 p-4"  action="/pettycash/store" method="POST" style="background-color: rgb(232, 232, 232); border-radius: 15px;">
            @csrf
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" class="form-control" id="date" aria-describedby="emailHelp">
                <span style="color: red">@error('date')
                    {{$message}}
                @enderror</span>
              </div>
              <div  class="mb-3">
                <label for="description">Description</label>

                <textarea id="description" class="form-control" name="description" rows="2" cols="50"></textarea>
                <span style="color: red">@error('description')
                    {{$message}}
                @enderror</span>
              </div>
            <div class="mb-3">
              <label for="amount" class="form-label">Amount</label>
              <input type="number" class="form-control" name="amount" id="amount" aria-describedby="emailHelp">
              <span style="color: red">@error('amount')
                {{$message}}
            @enderror</span>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>

                <select name="type" class="form-control" id="type">
                  <option value="" selected disabled>Select Expense Type</option>
                  <option value="stationary">Stationary</option>
                  <option value="travelling">Travelling</option>
                  <option value="postage">Postage</option>
                  <option value="others">Others</option>
                </select>
                <span style="color: red">@error('type')
                    {{$message}}
                @enderror</span>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
          </form>
    </div>
    <div class="col-md-8" style="margin-top: 20px;">
        <h5 style="text-align: center">Petty Cash Journal</h5>
        <table class="table table-bordered container">
            <thead>
              <tr>
                <th scope="col" rowspan="2">Date</th>
                <th scope="col" rowspan="2">Description</th>
                <th scope="col" rowspan="2">V/N</th>
                <th scope="col" rowspan="2">Amount</th>
                <th scope="col" colspan="4" style="text-align: center">Analyses of expenses</th>
                <th scope="col" rowspan="2">L/F</th>
                <th scope="col" rowspan="2"></th>
              </tr>
              <tr>
                <th scope="col">Stationary</th>
                <th scope="col">Travelling</th>
                <th scope="col">Postage</th>
                <th scope="col">Others</th>
              </tr>
            </thead>
            <tbody>
                {{-- show list of data using foreach --}}
                @foreach ($pettycash as $transaction)
              <tr>
                    <td>{{$transaction->date}}</td>
                    <td>{{$transaction->description}}</td>
                    <td></td>
                    <td>{{number_format((float)$transaction->amount, 2, '.', '')}}</td>

                    <td>
                        @if ($transaction->type == "stationary")
                        {{number_format((float)$transaction->amount, 2, '.', '')}}
                        @endif
                    </td>
                    <td>
                        @if ($transaction->type == "travelling")
                        {{number_format((float)$transaction->amount, 2, '.', '')}}
                        @endif
                    </td>
                    <td>
                        @if ($transaction->type == "postage")
                        {{number_format((float)$transaction->amount, 2, '.', '')}}
                        @endif
                    </td>
                    <td>
                        @if ($transaction->type == "others")
                        {{number_format((float)$transaction->amount, 2, '.', '')}}
                        @endif
                    </td>

                    <td> </td>
                    <td> 
                        <a href="{{"delete/".$transaction->id}}"><i class="fa fa-trash" style="color: red"></i> </a>
                    </td>
              </tr>
              @endforeach
              
              {{-- display the variable returned from the controller --}}
              <tr>
               <td></td>
               <td></td>
               <td></td>
               <td> <div style="font-weight: bold; color: rgb(86, 86, 192)"> {{number_format((float)$amountTotal, 2, '.', '')}} </div></td>
               <td> <div style="font-weight: bold; color: rgb(86, 86, 192)"> {{number_format((float)$stationaryTotal, 2, '.', '')}} </div></td>
               <td> <div style="font-weight: bold; color: rgb(86, 86, 192)"> {{number_format((float)$travellingTotal, 2, '.', '')}} </div></td>
               <td> <div style="font-weight: bold; color: rgb(86, 86, 192)"> {{number_format((float)$postageTotal, 2, '.', '')}} </div></td>
               <td> <div style="font-weight: bold; color: rgb(86, 86, 192)"> {{number_format((float)$othersTotal, 2, '.', '')}} </div></td>
               <td> </td>
               <td> </td>
              </tr>
            </tbody>
          </table>
    </div>
</div>

    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>