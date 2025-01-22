<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Pesanan') }}
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('orders.create') }}" />
        </div>
    </div>

    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Tampilkan
                <div class="mx-2 d-inline-block">
                    <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="hasil per halaman">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </select>
                </div>
                data
            </div>
            <div class="ms-auto text-secondary">
                Cari:
                <div class="ms-2 d-inline-block">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm" aria-label="Cari invoice">
                </div>
            </div>
        </div>
    </div>

    <x-spinner.loading-spinner/>

    <div class="table-responsive">
        <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle text-center w-1">
                        {{ __('No.') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('invoice_no')" href="#" role="button">
                            {{ __('No. Invoice') }}
                            @include('inclues._sort-icon', ['field' => 'invoice_no'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('customer_id')" href="#" role="button">
                            {{ __('Pelanggan') }}
                            @include('inclues._sort-icon', ['field' => 'customer_id'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('order_date')" href="#" role="button">
                            {{ __('Tanggal') }}
                            @include('inclues._sort-icon', ['field' => 'order_date'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('payment_type')" href="#" role="button">
                            {{ __('Pembayaran') }}
                            @include('inclues._sort-icon', ['field' => 'payment_type'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('total')" href="#" role="button">
                            {{ __('Total') }}
                            @include('inclues._sort-icon', ['field' => 'total'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('order_status')" href="#" role="button">
                            {{ __('Status') }}
                            @include('inclues._sort-icon', ['field' => 'order_status'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Tindakan') }}
                    </th>
                </tr>
            </thead>
            <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td class="align-middle text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $order->invoice_no }}
                    </td>
                    <td class="align-middle">
                        {{ $order->customer->name }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $order->order_date->format('d-m-Y') }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $order->payment_type }}
                    </td>
                    <td class="align-middle text-center">
                        {{ Number::currency($order->total, 'IDR') }}
                    </td>
                    <td class="align-middle text-center">
                        <x-status dot color="{{ $order->order_status === \App\Enums\OrderStatus::COMPLETE ? 'green' : 'orange' }}"
                                  class="text-uppercase"
                        >
                            {{ $order->order_status->label() }}
                        </x-status>
                    </td>
                    <td class="align-middle text-center" style="width: 5%">
                        <x-button.show class="btn-icon" route="{{ route('orders.show', $order) }}"/>
                        <x-button.print class="btn-icon" route="{{ route('order.downloadInvoice', $order) }}"/>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="align-middle text-center" colspan="8">
                        Tidak ada data yang ditemukan
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Menampilkan <span>{{ $orders->firstItem() }}</span> hingga <span>{{ $orders->lastItem() }}</span> dari <span>{{ $orders->total() }}</span> data
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $orders->links() }}
        </ul>
    </div>
</div>
