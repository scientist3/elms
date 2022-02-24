<style>
  .table td,
  .table th {
    vertical-align: middle;
  }
</style>
<thead>
  <tr class="bg-black">
    <th width="10%">Student Name</th>
    <th width="30%">Question Title</th>
    <th width="5%">Sno</th>
    <th width="35%">Options</th>
    <th width="5%">Correct</th>
    <th width="5%">Chosen</th>
    <th width="5%">Attempted</th>
    <th width="5%">Right?</th>
  </tr>
</thead>
<tbody>
  <?php if (!empty($responses)) {
    foreach ($responses as $student_id => $response) {
      $sl = 0;
      $total_attempted = 0;
      $total_correct = 0;
      foreach ($response as $question_id => $question) {
        if ($question_id == 'options_total_count') continue;
        $sl++;
        if ($question['correct']) {
          $total_correct++;
        }
        if ($question['attempted']) {
          $total_attempted++;
        }
        $question_count = count($response) + 1; ?>
        <tr>
          <!-- Student Name  -->
          <?php if ($sl == 1) { ?>
            <td rowspan="<?php echo $responses[$student_id]['options_total_count'] + 1; ?> "><?php echo $student_list[$student_id] ?></td>
          <?php } ?>
          <!-- Question -->
          <td colspan="1" rowspan="<?php echo count($question['options']) > 0 ? count($question['options']) + 1 : null; ?>">
            <?php echo $question['q_question'] ?>
          </td>
          <td class="bg-secondary"><strong>Sno</strong></td>
          <td class="bg-secondary"><strong>Value</strong></td>
          <td class="bg-secondary"><strong>Correct</strong></td>
          <td class="bg-secondary"><strong>Chosen</strong></td>
          <td class="bg-secondary"><strong>Attempted</strong></td>
          <td class="bg-secondary"><strong>Right?</strong></td>

        </tr>
        <?php
        $slc = 0;
        foreach ($question['options'] as $option) {

          $slc++; ?>
          <tr>
            <td class="bg-lightblue"><?php echo $slc ?></td>
            <td class="bg-lightblue"><?php echo $option['o_value'] ?></td>
            <?php if ($option['o_correct']) { ?>
              <td class="bg-info text-center" width="10px"><i class="fa fa-check"></i></td>
            <?php } else { ?>
              <td></td>
              <!-- <td class="bg-warning text-center" width="10px"><i class="fa fa-times"></i></td> -->
            <?php } ?>

            <?php if ($option['o_id'] == $question['chosen']) { ?>
              <td class="<?php echo ($option['o_correct']) ? 'bg-success' : 'bg-danger'; ?> text-center" width="10px">
                <i class="fa  fa-check "></i>
              </td>
            <?php } else { ?>
              <td></td>
            <?php } ?>

            <?php if ($slc == 1) { ?>
              <td class="text-center" rowspan="<?php echo count($question['options']) > 0 ? count($question['options']) : null; ?>"><?php echo ($question['attempted']) ? '<i class="fa  fa-check"></i>' : '<i class="fa  fa-times"></i> '; ?></td>

              <td class="text-center" rowspan="<?php echo count($question['options']) > 0 ? count($question['options']) : null; ?>">
                <?php echo ($question['correct']) ? '<i class="fa  fa-check"></i>' : '<i class="fa  fa-times"></i> '; ?>
              </td>
            <?php } ?>
          </tr>
        <?php }
        ?>
      <?php } ?>
      <tr>
        <td class="bg-black" colspan="6"> Total Of Student => <strong><?php echo $student_list[$student_id]; ?></strong></td>
        <td class="bg-black" colspan="1"> <?php echo $total_attempted; ?></td>
        <td class="bg-black" colspan="1"> <?php echo $total_correct; ?></td>
      </tr>
  <?php }
  } ?>

</tbody>