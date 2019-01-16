<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $data_trans = [];
        for ($i = 1; $i <= 20; $i++) {
            $data_client = [
                'sort' => $i,
                'status' => rand(0, 1)
            ];

            $logo = 'uploads/images/client_' . rand(1, 6) . '.png';
            $data_client_trans = [
                'name' => 'Công ty '.mb_strtoupper(str_random(4)).' VN',
                'address' => 'Số 123, đường số 123, Quận 1, VN',
                'email' => mb_strtolower(str_random(10)) . '@gmail.com',
                'phone' => rand(100000000, 999999999),
                'fax' => rand(100000000, 999999999),
                'website' => mb_strtolower(str_random(10)) . '.com',
                'job' => 'Chuyên đào tạo các lớp kỹ năng '.str_random(3),
                'content' => 'Giáo dục là quyền con người với sức mạnh to lớn để biến đổi. Trên nền tảng của nó, phần còn lại là nền tảng của tự do, dân chủ và phát triển con người bền vững.',
                'investment' => rand(100000000, 999999999),
                'staff' => rand(10, 500),
                'logo' => $logo,
                'school_id' => rand(1, 4),
                'language_id' => 1,
                'translation_id' => $i
            ];
            $data_client_trans2 = [
                'name' => 'Công ty '.mb_strtoupper(str_random(4)).' EN',
                'address' => 'Số 123, đường số 123, Quận 1, EN',
                'email' => mb_strtolower(str_random(10)) . '@gmail.com',
                'phone' => rand(100000000, 999999999),
                'fax' => rand(100000000, 999999999),
                'website' => mb_strtolower(str_random(10)) . '.com',
                'job' => 'Chuyên đào tạo các lớp kỹ năng '.str_random(3),
                'content' => 'Giáo dục là quyền con người với sức mạnh to lớn để biến đổi. Trên nền tảng của nó, phần còn lại là nền tảng của tự do, dân chủ và phát triển con người bền vững.',
                'investment' => rand(100000000, 999999999),
                'staff' => rand(10, 500),
                'logo' => $logo,
                'school_id' => rand(1, 4),
                'language_id' => 2,
                'translation_id' => $i
            ];
            array_push($data, $data_client);
            array_push($data_trans, $data_client_trans);
            array_push($data_trans, $data_client_trans2);
        }
        DB::table('m_client')->insert($data);
        DB::table('m_client_translation')->insert($data_trans);

        $data_ads = [];
        $data_ads_trans = [];
        for ($i = 1; $i <= 200; $i++) {
            $position = rand(1,6);
            $date = \Carbon\Carbon::create(2018, 11, 20, 0, 0, 0);
            $advert = [
                'type' => rand(1, 4),
                'position' => $position,
                'target' => rand(1,3),
                'link' => 'https://www.google.com.vn/search?q=KEYWORD_'.$i,
                'start_date'  => $date->format('Y-m-d H:i:s'),
                'end_date'  => $date->addWeeks(rand(1, 100))->format('Y-m-d H:i:s'),
                'status' => rand(0,1)
            ];
            array_push($data_ads, $advert);

            if($position == 3) {
                $imgs = 'uploads/images/ads_1.png';
            } else {
                $imgs = 'uploads/images/ads_2.png';
            }
            $advert_1 = [
                'content' => 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker. Trái với quan điểm chung của số đông, Lorem Ipsum không phải chỉ là một đoạn văn bản ngẫu nhiên. Người ta tìm thấy nguồn gốc của nó từ những tác phẩm văn học la-tinh cổ điển xuất hiện từ năm 45 trước Công Nguyên, nghĩa là nó đã có khoảng hơn 2000 tuổi. Một giáo sư của trường Hampden-Sydney College (bang Virginia - Mỹ) quan tâm tới một trong những từ la-tinh khó hiểu nhất, "consectetur", trích từ một đoạn của Lorem Ipsum, và đã nghiên cứu tất cả các ứng dụng của từ này trong văn học cổ điển, để từ đó tìm ra nguồn gốc không thể chối cãi của Lorem Ipsum. Thật ra, nó được tìm thấy trong các đoạn 1.10.32 và 1.10.33 của "De Finibus Bonorum et Malorum" (Đỉnh tối thượng của Cái Tốt và Cái Xấu) viết bởi Cicero vào năm 45 trước Công Nguyên. Cuốn sách này là một luận thuyết đạo lí rất phổ biến trong thời kì Phục Hưng. Dòng đầu tiên của Lorem Ipsum, "Lorem ipsum dolor sit amet..." được trích từ một câu trong đoạn thứ 1.10.32.',
                'image' => $imgs,
                'language_id' => 1,
                'translation_id' => $i,
            ];
            $advert_2 = [
                'content' => 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker. Trái với quan điểm chung của số đông, Lorem Ipsum không phải chỉ là một đoạn văn bản ngẫu nhiên. Người ta tìm thấy nguồn gốc của nó từ những tác phẩm văn học la-tinh cổ điển xuất hiện từ năm 45 trước Công Nguyên, nghĩa là nó đã có khoảng hơn 2000 tuổi. Một giáo sư của trường Hampden-Sydney College (bang Virginia - Mỹ) quan tâm tới một trong những từ la-tinh khó hiểu nhất, "consectetur", trích từ một đoạn của Lorem Ipsum, và đã nghiên cứu tất cả các ứng dụng của từ này trong văn học cổ điển, để từ đó tìm ra nguồn gốc không thể chối cãi của Lorem Ipsum. Thật ra, nó được tìm thấy trong các đoạn 1.10.32 và 1.10.33 của "De Finibus Bonorum et Malorum" (Đỉnh tối thượng của Cái Tốt và Cái Xấu) viết bởi Cicero vào năm 45 trước Công Nguyên. Cuốn sách này là một luận thuyết đạo lí rất phổ biến trong thời kì Phục Hưng. Dòng đầu tiên của Lorem Ipsum, "Lorem ipsum dolor sit amet..." được trích từ một câu trong đoạn thứ 1.10.32.',
                'image' => $imgs,
                'language_id' => 2,
                'translation_id' => $i,
            ];
            array_push($data_ads_trans, $advert_1);
            array_push($data_ads_trans, $advert_2);
        }
        DB::table('m_adverts')->insert($data_ads);
        DB::table('m_adverts_translation')->insert($data_ads_trans);
        unset($data);
        unset($data_trans);
        unset($data_ads);
        unset($data_ads_trans);
    }
}
