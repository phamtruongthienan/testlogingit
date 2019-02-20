<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event = [];
        $event_translation = [];
        $slug = [];
        for ($i = 1; $i <= 200; $i++) {
            $type = rand(1, 2);
            $date_type = rand(1, 2);
            if ($date_type == 1) {
                $start_date = null;
                $end_date = null;
            } else {
                $start_date = '2018-11-13 08:00:00';
                $end_date = '2018-11-20 08:00:00';
            }
            $discount_type = rand(1, 2);
            if ($discount_type == 1) {
                $discount = rand(10, 50);
            } else {
                $discount = rand(500000, 3000000);
            }
            $position = rand(1, 5);
            $status = rand(0, 1);
            $data = [
                'type' => $type,
                'target' => '[1,2,3,4]',
                'date_type' => $date_type,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'discount_type' => $discount_type,
                'discount' => $discount,
                'code' => mb_strtoupper(str_random(5)),
                'position' => $position,
                'status' => $status
            ];
            $logo = 'uploads/images/banner_' . rand(1, 3) . '.png';
            $data_translation1 = [
                'logo' => $logo,
                'slug' => 'promo/event-vn-post-' . $i,
                'name' => 'Event VN ' . $i,
                'content' => 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker. Trái với quan điểm chung của số đông, Lorem Ipsum không phải chỉ là một đoạn văn bản ngẫu nhiên. Người ta tìm thấy nguồn gốc của nó từ những tác phẩm văn học la-tinh cổ điển xuất hiện từ năm 45 trước Công Nguyên, nghĩa là nó đã có khoảng hơn 2000 tuổi. Một giáo sư của trường Hampden-Sydney College (bang Virginia - Mỹ) quan tâm tới một trong những từ la-tinh khó hiểu nhất, "consectetur", trích từ một đoạn của Lorem Ipsum, và đã nghiên cứu tất cả các ứng dụng của từ này trong văn học cổ điển, để từ đó tìm ra nguồn gốc không thể chối cãi của Lorem Ipsum. Thật ra, nó được tìm thấy trong các đoạn 1.10.32 và 1.10.33 của "De Finibus Bonorum et Malorum" (Đỉnh tối thượng của Cái Tốt và Cái Xấu) viết bởi Cicero vào năm 45 trước Công Nguyên. Cuốn sách này là một luận thuyết đạo lí rất phổ biến trong thời kì Phục Hưng. Dòng đầu tiên của Lorem Ipsum, "Lorem ipsum dolor sit amet..." được trích từ một câu trong đoạn thứ 1.10.32. ',
                'language_id' => 1,
                'translation_id' => $i
            ];
            $data_translation2 = [
                'logo' => $logo,
                'slug' => 'promo/event-en-post-' . $i,
                'name' => 'Event EN ' . $i,
                'content' => 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker. Trái với quan điểm chung của số đông, Lorem Ipsum không phải chỉ là một đoạn văn bản ngẫu nhiên. Người ta tìm thấy nguồn gốc của nó từ những tác phẩm văn học la-tinh cổ điển xuất hiện từ năm 45 trước Công Nguyên, nghĩa là nó đã có khoảng hơn 2000 tuổi. Một giáo sư của trường Hampden-Sydney College (bang Virginia - Mỹ) quan tâm tới một trong những từ la-tinh khó hiểu nhất, "consectetur", trích từ một đoạn của Lorem Ipsum, và đã nghiên cứu tất cả các ứng dụng của từ này trong văn học cổ điển, để từ đó tìm ra nguồn gốc không thể chối cãi của Lorem Ipsum. Thật ra, nó được tìm thấy trong các đoạn 1.10.32 và 1.10.33 của "De Finibus Bonorum et Malorum" (Đỉnh tối thượng của Cái Tốt và Cái Xấu) viết bởi Cicero vào năm 45 trước Công Nguyên. Cuốn sách này là một luận thuyết đạo lí rất phổ biến trong thời kì Phục Hưng. Dòng đầu tiên của Lorem Ipsum, "Lorem ipsum dolor sit amet..." được trích từ một câu trong đoạn thứ 1.10.32.',
                'language_id' => 2,
                'translation_id' => $i
            ];
            $data_slug = [
                'slug' => 'promo/event-vn-post-' . $i,
                'category' => 'm_event'
            ];
            $data_slug2 = [
                'slug' => 'promo/event-en-post-' . $i,
                'category' => 'm_event'
            ];
          
            array_push($event_translation, $data_translation1);
            array_push($event_translation, $data_translation2);
            array_push($slug, $data_slug);
            array_push($slug, $data_slug2);
           
            array_push($event, $data);
        }
        for ($i = 1; $i <= 16; $i++) {
            $data_slug3 = [
                'slug' => 'course/vn-' . $i,
                'category' => 'm_school_course'
            ];
            array_push($slug, $data_slug3);
        }
        for ($i = 1; $i <= 16; $i++) {
            $data_slug3 = [
                'slug' => 'course/en-' . $i,
                'category' => 'm_school_course'
            ];
            array_push($slug, $data_slug3);
        }
        DB::table('m_school_event')->insert($event);
        DB::table('m_school_event_translation')->insert($event_translation);

        DB::table('m_slug')->insert($slug);
        unset($event);
        unset($event_translation);
        unset($slug);
    }
}
