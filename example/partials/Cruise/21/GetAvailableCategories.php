<div class="table-responsive">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th width="25%">Name</th>
            <th>Code</th>
            <th>Description</th>
            <th>Price (EUR)</th>
            <th>Price Desc.</th>
            <th>Available</th>
            <th>Choose</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category_type => $sub_categories) : ?>
        <tr>
            <td colspan="8" class="category_type"><h5>
                    Type: <?php echo $category_type; ?></h5></td>
        </tr>
        <?php foreach ($sub_categories as $key => $category): ?>
        <tr class="category">
            <td class="name"><span><?php echo $category->Name; ?></span></td>
            <td class="code"><?php echo $category->Code; ?></td>
            <td class="description">
                <?php if ($category->AdditionalDescription): ?>
                            <span class="description" title="<?php echo $category->AdditionalDescription; ?>">
            <img src="{image_path('img/icons/information.png')}"/>
          </span>
                    <?php endif; ?>
                <a href="<?php echo $category->URL; ?>" target="_blank"><img src="{image_path('img/icons/video.gif')}"/></a>
            </td>
            <td class="price"><?php echo $category->Price->GuestPrice->Amount; ?></td>
            <td class="price_desc"><?php echo $category->Price->GuestPrice->Description; ?></td>
            <td class="available"><?php echo ($category->Availability === 'true') ? 'Yes' : 'No'; ?></td>
            <td class="choose">
                <?php if ($category->Availability === 'true'): ?>
                <input type="radio" name="category_value" value="<?php echo $category->Code; ?>"/>
                <?php endif; ?>
            </td>
        </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
