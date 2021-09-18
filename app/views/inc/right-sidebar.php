<div class="right-side col-md-3 pl-0">
    <div class="empty"></div>
    <div class="sidebar-container" style="display:none">
        <h3>Ukuba Unomdla</h3>
        <div class="sidebar-profile">
            <div class="sidebar-profile__info">
                <a href=""><h4><?php echo $data['umsebenzi']->gama_le_company; ?></h4></a>
                <p>Private hospital yase South Africa. Head Office yayo ise Stellenbosch, Western Cape.</p>
            </div>
            <div class="follow">
                <a href="" class="job-search__btn follow-btn"><i class="fas fa-plus"></i> Mlandele</a>
            </div>
        </div>
        <div class="sidebar-profile">
            <div class="sidebar-profile__info">
                <a href=""><h5><?php echo $data['umntu']->igama; ?></h5></a>
                <p>Sicenda abantu ngokubakhangelela and sibadibanise nemisebenzi edinga abantu.</p>
            </div>
            <div class="follow">
                <a href="" class="job-search__btn follow-btn"><i class="fas fa-plus"></i> Mlandele</a>
            </div>
        </div>
    </div>
    <div class="sidebar-container p-0 m-0 highlight-grey mb-3" style="display:block">
        <p class="mt-0 mb-1 pt-3 pl-3 pb-2 border-bottom-0">Cofa kulamagama asezantsi for eminye imisebenzi efana nale</p>
        <div class="related-jobs container">
            <ul>
            <?php if(!empty($data['umsebenzi']->msebenzi_onjani)) : ?>
            <li><p class="jb-recommend m-0 p-0"><a href="<?php echo URLROOT . "/" . $province_slug . '/onjani/' . $data['umsebenzi']->job_type_slug . "/"; ?>"><?php echo $data['umsebenzi']->msebenzi_onjani; ?></a>
            </p></li>
            <?php endif; ?>
            <?php if(!empty($data['umsebenzi']->ngowantoni)) : ?>
                <li>
                <p class="jb-recommend m-0 p-0">
                <?php if($data["umsebenzi"]->ngowantoni == "Government") : ?>
                <a href="<?php echo URLROOT . '/pages' . '/ngowantoni/' . $data['umsebenzi']->job_category_slug . "/"; ?>"><?php echo $data['umsebenzi']->ngowantoni; ?></a>
                <?php elseif($data["umsebenzi"]->ngowantoni == "Driver") : ?>
                <a href="<?php echo URLROOT . '/pages' . '/ngowantoni/' . $data['umsebenzi']->job_category_slug . "/"; ?>">qhuba</a>
                <?php elseif($data["umsebenzi"]->ngowantoni == "Cashier" || $data["umsebenzi"]->ngowantoni == "Security") : ?>
                <a href="<?php echo URLROOT . '/pages' . '/ngowantoni/' . $data['umsebenzi']->job_category_slug . "/"; ?>"><?php echo $data['umsebenzi']->ngowantoni; ?></a>
                <?php elseif($data["umsebenzi"]->ngowantoni == "Call Centre" || $data["umsebenzi"]->ngowantoni == "Municipality") : ?>
                <a href="<?php echo URLROOT . '/pages' . '/ngowantoni/' . $data['umsebenzi']->job_category_slug . "/"; ?>"><?php echo $data['umsebenzi']->ngowantoni; ?></a>
                <?php else : ?>
                    <a href="<?php echo URLROOT . '/pages' . '/ngowantoni/' . $data['umsebenzi']->job_category_slug . "/"; ?>"><?php echo $data['umsebenzi']->ngowantoni; ?></a>
                <?php endif; ?>
            </p>
                </li>
            <?php endif; ?>
                    <li>
                    <p class="jb-recommend m-0 p-0">
                <?php $college = "College";
                $university = "University";
                $municipality = "Municipality";
                $varsity = strpos($data['umsebenzi']->gama_le_company, $university);
                $municipality = strpos($data['umsebenzi']->gama_le_company, $municipality);
                $str = strpos($data['umsebenzi']->gama_le_company, $college);?>
                <?php if($str !== false || $varsity !== false || $municipality !== false) : ?>
                    <a href="<?php echo URLROOT . '/pages' . '/employer/' . $data['umsebenzi']->employer_slug . "/"; ?>"><?php echo $data['umsebenzi']->gama_le_company; ?></a>
                <?php else : ?>
                <a href="<?php echo URLROOT . '/pages' . '/employer/' . $data['umsebenzi']->employer_slug . "/"; ?>"><?php echo $data['umsebenzi']->gama_le_company; ?></a>
                <?php endif; ?>
            </p>
                    </li>
                <li>            
                    <p class="jb-recommend m-0 p-0">
                <?php if($data['umsebenzi']->ndawoni == "Various Areas") : ?>
                <a href="<?php echo URLROOT . '/' . $province_slug . '/ndawoni/' . $data['umsebenzi']->location_slug . "/"; ?>">ndawo ezohlukeneyo</a>
                <?php else : ?>
                 <a href="<?php echo URLROOT . '/' . $province_slug . '/ndawoni/' . $data['umsebenzi']->location_slug . "/"; ?>"><?php echo $data['umsebenzi']->ndawoni; ?></a>
                <?php endif; ?>
                </p>
            </li>
                <li>            
                    <p class="jb-recommend m-0 p-0">
                <?php if($data['umsebenzi']->province == "KwaZulu-Natal") : ?>
                <a href="<?php echo URLROOT . '/' . $province_slug . "/"; ?>">KZN</a>
                <?php else : ?>
                    <a href="<?php echo URLROOT . '/' . $province_slug . "/"; ?>"><?php echo $data['umsebenzi']->province; ?></a>
                <?php endif; ?>
                </p>
            </li>
            </ul>
        </div>
    </div>
    <?php if(isset($_SESSION['id_yomntu']) && $_SESSION['id_yomntu'] === '2'): ?>
    <table class="table table-borderless highlight-grey p-3 meta-table">
        <thead>
            <tr>
                <th class="p-0 pb-3"><h3><?php echo $data['umsebenzi']->gama_le_company ?></h3></th>
            </tr>
        </thead>
        <tbody>
            <tr class="jb-recommend pb-1">
                <th class="p-0"><strong>Head Office</strong></th>
                <td class="p-0">Finish this up</td>
            </tr>
            <tr class="jb-recommend pb-1">
                <th class="p-0"><strong>Website</strong></th>
                <td class="p-0"><a href="">tdornton</a></th>
            </tr>
            <tr class="jb-recommend pb-1">
                <th class="p-0"><strong>Facebook</strong></th>
                <td class="p-0"><a href="">@twitter</a></td>
            </tr>
            <tr class="jb-recommend pb-1">
                <th class="p-0"><strong>LinkedIn</strong></th>
                <td class="p-0"><a href="">@twitter</a></td>
            </tr>
            <tr class="jb-recommend pb-1">
                <th class="p-0"><strong>Vacancies</strong></th>
                <td class="p-0"><a href="">@twitter</a></td>
            </tr>
            <tr class="jb-recommend pb-1">
                <th class="p-0"><strong>Contact Info</strong></th>
                <td class="p-0"><a href="">@twitter</a></td>
            </tr>
        </tbody>
    </table>
    <?php endif; ?>
    
</div>