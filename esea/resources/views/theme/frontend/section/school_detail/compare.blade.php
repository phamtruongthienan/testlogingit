{{-- <div class="section-22">
    <div class="container-16-copy w-container">
        <h2 class="heading-product-menu">Compare to other recommended</h2>
        <div class="div-block-1156">
            <div class="div-block-1157">
                <div class="div-block-56-no-2">
                    <div class="div-block-no-photo"></div>
                    <div class="div-block-39">
                        <div class="div-block-1135"></div>
                        <div class="text-block-city-4">{{$school_detail[0]->mSchooltranslations[0]->address}}</div>
                    </div>
                    <h3 class="heading-3-compare-3"><strong>{{$school_detail[0]->mSchooltranslations[0]->name}}</strong>
                    </h3>
                    <div class="div-block-95">
                        @for($i = 1; $i <= $school_detail[0]->rating; $i++)
                            <div class="div-block-1129"></div>
                        @endfor
                    </div>
                    <div class="text-block-32-copy"><strong class="bold-text-8">{{$school_detail[0]->rating}}</strong>
                        reviews<br>
                        <strong class="bold-text-8">
                            @php
                                $total_teacher = 0;
                            @endphp
                            @foreach($school_detail[0]->mSchoolteachers as $key => $val)
                                @php
                                    $total_teacher += $val->num_teacher
                                @endphp
                            @endforeach
                            {{$total_teacher}}</strong> teachers
                    </div>
                    <a href="#" class="button-3-copy-2 w-button">Book to visit</a></div>
            </div>
            <div class="div-block-1132">
                <div class="div-block-53"></div>
                <div class="div-block-39">
                    <div class="div-block-1135"></div>
                    <div class="text-block-city-4">HO CHI MINH</div>
                </div>
                <h3 class="heading-3-compare-3">Wonderkids Kindergarten</h3>
                <div class="div-block-95">
                    <div class="div-block-1129"></div>
                    <div class="div-block-1129"></div>
                    <div class="div-block-1129"></div>
                </div>
                <div class="text-block-32-copy"><strong class="bold-text-8">351</strong> reviews<br><strong
                            class="bold-text-8">96</strong> teachers<br><strong class="bold-text-8">590</strong>
                    students
                </div>
                <a href="#" class="button-10 w-button">View school</a></div>

        </div>
    </div>
</div> --}}