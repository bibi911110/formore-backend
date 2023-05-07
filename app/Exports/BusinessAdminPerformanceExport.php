<?php



namespace App\Exports;
use App\Models\Transaction;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
class BusinessAdminPerformanceExport implements FromCollection, WithHeadings
{
    private $data;
    public function __construct( $data )
    {
        $this->data = $data;
       //return $this;
    }
    public function headings(): array
    {
        return [
            'From',
            'To',
            'Branch',
            'Stamp',
            'Points',
            'Free Voucher',
            'Super Deal',
            'Super Code',
            'Birthday',
            'Welcome',
            
        ];
    }
    public function collection()
    {
        $array = [];
        
        //foreach ($this->data as $value) {
            $array[] = [
                        "fromDate"=>$this->data['fromDate'],
                        "toDate"=>$this->data['toDate'],
                        "business_name"=>$this->data['business_name'],
                        "rewardsStamp"=>$this->data['rewardsStamp'],
                        "rewardsPoint"=>$this->data['rewardsPoint'],
                        "freeVoucher"=>$this->data['freeVoucher'],
                        "superDeal"=>$this->data['superDeal'],
                        "superCode"=>$this->data['superCode'],
                        "birthdayCount"=>$this->data['birthdayCount'],
                        "welcomeCount"=>$this->data['welcomeCount'],
                        
                        ];
        //}
        return collect($array);
    }
}

