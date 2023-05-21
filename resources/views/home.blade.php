@extends('layouts.app')

@section('content')
<script>
	var id = {{Auth::user()->id}}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Current Rate</div>

                <div class="card-body">
					<table>
						  <thead>
							<tr>
							  <th>Name</th>
							  <th>Requested Amount (RM)</th>
							  <th>Exchange Rate</th>
							  <th>Requested Amount (USD)</th>
							  <th>Action</th>
							</tr>
						  </thead>
						  <tbody>
							<tr v-for="(row, index) in rows" :key="index">
							  <td><input type="text" v-model="row.name" /></td>
							  <td><input type="number" v-model="row.price_in_rm" /></td>
							  <td>@{{ row.exchange_rate }}</td>
							  <td>@{{ row.price_in_rm * row.exchange_rate  }}</td>
							  <td>
								<button @click="saveRow(index)">Update</button>
								<button @click="deleteRow(index)">Delete</button>
							  </td>
							</tr>
						  </tbody>
						</table>
						<button @click="addRow">Add Row</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
