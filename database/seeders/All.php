<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class All extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('`noi_lam_viecs`')
        //     ->insert([['`id`'=>1,'`ma_noi_lam_viec`'=>'TPHCM1','`dia_chi`'=>'123 Dia Chi ','`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null],['`id`'=>2,'`ma_noi_lam_viec`'=>'TPHCM2','`dia_chi`'=>'456 Dia Chi','`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null]]);
        
        // DB::table('`loai_tai_khoans`')
        //     ->insert([['`id`'=>1,'`ten_loai_tai_khoan`'=>'admin','`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null],['`id`'=>2,'`ten_loai_tai_khoan`'=>'user thuong','`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null]]);
        
        // DB::table('`loai_san_phams`')
        //     ->insert([['`id`'=>1,'`ten_loai_san_pham`'=>'thuc an','`hinh_anh`'=>'hamburger.jpg','`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null],['`id`'=>2,'`ten_loai_san_pham`'=>'thuc uong','`hinh_anh`'=>'trasua.jpg','`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null]]);
       
        // DB::table('`loai_khuyen_mais`')
        //     ->insert([['`id`'=>1,'`ten_loai_khuyen_mai`'=>'Voucher','`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null],['`id`'=>2,'`ten_loai_khuyen_mai`'=>'Sales','`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null]]);
       
        // DB::table('`khuyen_mais`')
        //     ->insert([['`id`'=>1,'`ma_khuyen_mai`'=>'newyear','`loai_khuyen_mai_id`'=>1,'`ngay_bat_dau`'=>'2022-01-01 00:00:00','`ngay_ket_thuc`'=>'2022-04-03 23:59:59','`gia_tri`'=>50,'`maximum`'=>25000,'`trang_thai`'=>0],['`id`'=>2,'`ma_khuyen_mai`'=>'abc','`loai_khuyen_mai_id`'=>2,'`ngay_bat_dau`'=>'2022-01-01 00:00:00','`ngay_ket_thuc`'=>'2022-12-31 23:59:56','`gia_tri`'=>30,'`maximum`'=>0,'`trang_thai`'=>1],['`id`'=>3,'`ma_khuyen_mai`'=>'nothing','`loai_khuyen_mai_id`'=>2,'`ngay_bat_dau`'=>'2022-01-01 00:00:00','`ngay_ket_thuc`'=>'2022-12-31 23:59:59','`gia_tri`'=>0,'`maximum`'=>0,'`trang_thai`'=>1]]);
        
        // DB::table('`chuc_vus`')
        //     ->insert([['`id`'=>1,'`ten_chuc_vu`'=>'Quan Ly','`thuong`'=>10.00,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null],['`id`'=>2,'`ten_chuc_vu`'=>'Nhan Vien','`thuong`'=>5.00,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null]]);

        // DB::table('`don_vi_tinhs`')
        //     ->insert([['`id`'=>1,'`ten_don_vi_tinh`'=>'Kg','`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null],['`id`'=>2,'`ten_don_vi_tinh`'=>'Lit','`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null]]);
      
        // DB::table('`hoa_dons`')
        //     ->insert(['`id`'=>1,'`voucher`'=>'','`nguoi_nhan_hang`'=>'test1','`dia_chi_nguoi_nhan_hang`'=>'123 Dia Chi','`sdt_nguoi_nhan_hang`'=>'0123456789','`tong_tien`'=>120000.00,'`tai_khoan_id`'=>1,'`nhan_vien_id`'=>1,'`trang_thai`'=>'3','`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null]);

        // DB::table('`binh_luans`')
        //     ->insert(['`id`'=>1,'`noi_dung`'=>'Good','`tai_khoan_id`'=>1,'`san_pham_id`'=>1,'`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null]);
        // //
        // DB::table('`danh_gias`')
        //     ->insert(['`id`'=>1,'`yeu_thich`'=>1,'`so_sao`'=>5,'`tai_khoan_id`'=>1,'`san_pham_id`'=>1,'`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null]);
    
        // DB::table('`san_phams`')
        //     ->insert([['`id`'=>1,'`ten_san_pham`'=>'Hamburger','`mo_ta`'=>'Hamburger là một loại thức ăn bao gồm bánh mì kẹp thịt xay (thường là thịt bò) ở giữa. Miếng thịt có thể được nướng, chiên, hun khói hay nướng trên lửa. Hamburger thường ăn kèm với pho mát, rau diếp, cà chua, hành tây, dưa chuột muối chua, thịt xông khói, hoặc ớt; ngoài ra, các loại gia vị như sốt cà chua, mù tạt, sốt mayonnaise, đồ gia vị, hoặc \"nước xốt đặc biệt\", (thường là một biến tấu của sốt Thousand Island) cũng có thể thể rưới lên món bánh. Loại bánh hamburger có topping là pho mát được mọi người gọi là hamburger pho mát.','`gia`'=>50000.00,'`hinh`'=>'hamburger.jpg','`loai_san_pham_id`'=>1,'`khuyen_mai_id`'=>3,'`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null,'`deleted_at`'=>null],['`id`'=>2,'`ten_san_pham`'=>'Ga Ran','`mo_ta`'=>'Gà Rán là một món ăn xuất xứ từ miền Nam Hoa Kỳ; nguyên liệu chính là những miếng thịt gà đã được lăn bột rồi chiên trên chảo, chiên ngập dầu, chiên áp suất hoặc chiên chân không. Lớp bột chiên xù sẽ giúp cho miếng gà có một lớp vỏ ngoài giòn rụm, còn phần thịt bên trong vẫn mềm và mọng nước. Nguyên liệu được sử dụng phổ biến nhất là gà thịt. Những tính từ dùng để mô tả món gà rán là \"giòn rụm\", \"mọng\", \"giòn tan\"; hoặc cũng có thể là \"cay\" hoặc \"mặn\". Tùy cách chế biến mà cũng có thể cho một số loại ớt như bột paprika, hoặc tương ớt lên gà rán để tạo vị cay.','`gia`'=>70000.00,'`hinh`'=>'6.jpg','`loai_san_pham_id`'=>1,'`khuyen_mai_id`'=>2,'`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null,'`deleted_at`'=>null],['`id`'=>3,'`ten_san_pham`'=>'Tra Sua','`mo_ta`'=>'Trà sữa là loại trà được kết hợp giữa trà và sữa. Khi nhắc đến trà sữa thì người Việt chúng ta sẽ nghĩ ngay đến những ly trà sữa mát lạnh với những hạt trân châu dẻo ngọt. Tục uống trà đã đi vào cả thư pháp, nghệ thuật cắm hoa và nghệ thuật hương đạo, chịu ảnh hưởng nhiều của văn hóa uống trà Trung Quốc. Trà trở thành một thức uống phổ biến và thông dụng, được nhiều người ưa thích.','`gia`'=>20000.00,'`hinh`'=>'trasua.jpg','`loai_san_pham_id`'=>2,'`khuyen_mai_id`'=>3,'`trang_thai`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null,'`deleted_at`'=>null]]);
        
        // DB::table('`tai_khoans`')
        //     ->insert([['`id`'=>1,'`email`'=>'test1@gmail.com','`mat_khau`'=>'123456','`dia_chi`'=>'','`ngay_sinh`'=>'','`sdt`'=>'','`ho_ten`'=>'test1','`loai_tai_khoan_id`'=>2,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null,'`trang_thai`'=>1],['`id`'=>2,'`email`'=>'admin@gmail.com','`mat_khau`'=>'123456','`dia_chi`'=>'','`ngay_sinh`'=>'','`sdt`'=>'','`ho_ten`'=>'admin','`loai_tai_khoan_id`'=>1,'`created_at`'=>'2022-04-01 17:00:00','`updated_at`'=>null,'`trang_thai`'=>1]]);
    }
}
