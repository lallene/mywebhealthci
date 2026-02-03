<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class StockTable extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStock = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterStock($value)
    {
        $this->resetPage();
        $this->filterStock = $value;
    }

    public function render()
    {
        $stocks = DB::table('medications')
            ->leftJoin('stocks', 'medications.id', '=', 'stocks.medication_id')
            ->select(
                'medications.id as stock_id',
                'medications.name as medication_name',
                'medications.famille_medicament',
                DB::raw('
                    (
                        (COALESCE(stocks.stock_site_1, 0) +
                        COALESCE(stocks.stock_site_2, 0) +
                        COALESCE(stocks.stock_site_3, 0)) * medications.tablet_count
                    ) as stock_global_initial
                '),
                DB::raw('
                    FLOOR(COALESCE(stocks.stock_site_1, 0) * medications.tablet_count) as stock_site_1
                '),
                DB::raw('
                    FLOOR(COALESCE(stocks.stock_site_2, 0) * medications.tablet_count) as stock_site_2
                '),
                DB::raw('
                    FLOOR(COALESCE(stocks.stock_site_3, 0) * medications.tablet_count) as stock_site_3
                '),
                // Ajout de la colonne stock_global_utilise
                DB::raw('
                    (COALESCE(stocks.stock_site_1, 0) + COALESCE(stocks.stock_site_2, 0) + COALESCE(stocks.stock_site_3, 0)) as stock_global_utilise
                ')
            )
            ->where(DB::raw('
                (COALESCE(stocks.stock_site_1, 0) +
                COALESCE(stocks.stock_site_2, 0) +
                COALESCE(stocks.stock_site_3, 0)) * medications.tablet_count
            '), '>', 0)
            ->when($this->search, function($query) {
                return $query->where('medications.name', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterStock, function($query) {
                if ($this->filterStock == 'epuise') {
                    return $query->where(function($q) {
                        $q->where('stocks.stock_site_1', '<=', 0)
                          ->orWhere('stocks.stock_site_2', '<=', 0)
                          ->orWhere('stocks.stock_site_3', '<=', 0);
                    });
                } elseif ($this->filterStock == 'disponible') {
                    return $query->where(function($q) {
                        $q->where('stocks.stock_site_1', '>', 0)
                          ->orWhere('stocks.stock_site_2', '>', 0)
                          ->orWhere('stocks.stock_site_3', '>', 0);
                    });
                }
            })
            ->paginate(50);

        return view('livewire.stock-table', compact('stocks'));
    }
}
