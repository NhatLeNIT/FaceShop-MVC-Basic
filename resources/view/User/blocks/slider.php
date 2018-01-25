<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 18:14
 */
?>
<style>
    #slider {
        max-height: 480px !important;
    }
</style>
<div class="container-fluid" style="padding-left: 0; padding-right: 0">
    <div class="slider-wrap">
        <div class="fullwidthbanner-container" >
            <div class="fullwidthbanner" id="slider">
                <ul>
<!--                    @foreach($data_slider as $item)-->
                    <li data-transition="fade" data-slotamount="3" data-masterspeed="300" data-saveperformance="on">
                        <!--MAIN IMAGE-->
                        <a href="#">
                            <img src="public/images/uploads/sliders/banner1.PNG" alt="" data-bgposition="center top" data-duration="" data-ease="Power0.easeInOut" data-bgfit="cover" data-bgrepeat="no-repeat" width="100%" />
                        </a>
                        <!-- LAYER NR. -->
                    </li>
                    <li data-transition="fade" data-slotamount="3" data-masterspeed="300" data-saveperformance="on">
                        <!--MAIN IMAGE-->
                        <a href="#">
                            <img src="public/images/uploads/sliders/banner2.PNG" alt="" data-bgposition="center top" data-duration="" data-ease="Power0.easeInOut" data-bgfit="cover" data-bgrepeat="no-repeat" width="100%" />
                        </a>
                        <!-- LAYER NR. -->
                    </li>
<!--                    @endforeach-->
                </ul>
            </div>
        </div>
    </div>
</div>
