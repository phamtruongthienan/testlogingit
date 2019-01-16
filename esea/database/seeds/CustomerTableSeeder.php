<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MCustomer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $data2 = [];
        $data3 = [];
        $data4 = [];
        $data5 = [];
        $data6 = [];
        $data7 = [];
        $child = [];

        for ($i = 1; $i < 100; $i++) {
            $subscribe = [
                'email' => str_random(10) . '@gmail.com',
                'status' => rand(0, 1)
            ];
            array_push($data2, $subscribe);
        }

        DB::table('m_subscribe')->insert($data2);
        unset($data2);
        unset($subscribe);

        
        for ($i = 1; $i < 100; $i++) {
            $user = [
                'email' => str_random(10) . '@gmail.com',
                'password' => Hash::make('123456'),
                'name' => str_random(10),
                'address' => str_random(10),
                'dob' => rand(1940, 2000) . '-' . rand(1, 12) . '-' . rand(1, 28),
                'phone' => rand(100000000, 999999999),
                'logo' => ('uploads/avatar/avatar_'.rand(1,5).'.png'),
                'type' => rand(1, 3),
                'gender' => rand(0, 2),
                'status' => rand(0, 1),
                'lat' => '15.880020',
                'long' => '108.325690'
            ];
            $data_child = [
                'customer_id' => $i,
                'name' => str_random(4) . ' ' . str_random(4) . ' ' . str_random(4),
                'dob' => rand(1991, 2017) . '-' . rand(1, 12) . '-' . rand(1, 28),
                'gender' => rand(0, 2),
                'genitive' => str_random(4) . ',' . str_random(4) . ',' . str_random(4) . ',' . str_random(4),
                'school_id' => rand(1, 4)
            ];
            array_push($child, $data_child);
            array_push($data, $user);
        }
        DB::table('m_customer')->insert($data);
        DB::table('m_child')->insert($child);
        unset($data);
        unset($child);
        unset($user);
        unset($data_child);

        $list_customer = MCustomer::where('status', 1)->get();
        foreach ($list_customer as $k => $v) {
            for ($i = 0; $i < 2; $i++) {
                $wishlist = [
                    'customer_id' => $v->id,
                    'school_id' => rand(1, 4)
                ];
                array_push($data3, $wishlist);
            }
            for ($is = 0; $is < 200; $is++) {
                $search = [
                    'customer_id' => $v->id,
                    'language_id' => rand(1, 2),
                    'keyword' => str_random(5)
                ];
                array_push($data4, $search);
            }
            $booking = [
                'login_customer' => 1,
                'booking_date' => rand(2018, 2019) . '-' . rand(1, 12) . '-' . rand(1, 28),
                'name' => $v->name,
                'phone' => $v->phone,
                'email' => $v->email,
                'content' => str_random(50),
                'status' => rand(0, 2),
                'status_booking' => rand(0, 1),
                'school_id' => rand(1, 4),
                'customer_id' => $v->id
            ];
            array_push($data5, $booking);

            $comment = [
                'customer_id' => $v->id,
                'content' => 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker. Trái với quan điểm chung của số đông, Lorem Ipsum không phải chỉ là một đoạn văn bản ngẫu nhiên. Người ta tìm thấy nguồn gốc của nó từ những tác phẩm văn học la-tinh cổ điển xuất hiện từ năm 45 trước Công Nguyên, nghĩa là nó đã có khoảng hơn 2000 tuổi. Một giáo sư của trường Hampden-Sydney College (bang Virginia - Mỹ) quan tâm tới một trong những từ la-tinh khó hiểu nhất, "consectetur", trích từ một đoạn của Lorem Ipsum, và đã nghiên cứu tất cả các ứng dụng của từ này trong văn học cổ điển, để từ đó tìm ra nguồn gốc không thể chối cãi của Lorem Ipsum. Thật ra, nó được tìm thấy trong các đoạn 1.10.32 và 1.10.33 của "De Finibus Bonorum et Malorum" (Đỉnh tối thượng của Cái Tốt và Cái Xấu) viết bởi Cicero vào năm 45 trước Công Nguyên. Cuốn sách này là một luận thuyết đạo lí rất phổ biến trong thời kì Phục Hưng. Dòng đầu tiên của Lorem Ipsum, "Lorem ipsum dolor sit amet..." được trích từ một câu trong đoạn thứ 1.10.32.',
                'rating' => rand(1, 5),
                'school_id' => rand(1, 4),
                'status' => rand(0, 1)
            ];
            array_push($data6, $comment);
        }
        DB::table('m_school_comment')->insert($data6);
        unset($wishlist);
        unset($search);
        unset($booking);
        unset($comment);
        unset($data6);
        unset($comment_rating);
        unset($comment_rating1);
        unset($comment_rating2);
        unset($comment_rating3);


        DB::table('m_wishlist')->insert($data3);
        unset($data3);
        DB::table('m_search')->insert($data4);
        unset($data4);
        DB::table('m_booking')->insert($data5);
        unset($data5);
    }
}
