<?php
/* RoughEst - Instant Estimate Calculator / Built By Inland Applications */
 class RoughEst_Sqft_Widget extends WP_Widget {
  
    /**
     * Register widget with WordPress.
     */
    function __construct() {
      parent::__construct(
        'roughest_widget_sqft', // Base ID
        esc_html__( 'RoughEst Sqft Calc', 'roughest' ), // Name
        array( 'description' => esc_html__( 'Calculate a price range based on square footage.', 'roughest' ), ) // Args
      );
    }
  
    /**
     * Front-end view
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
      echo $args['before_widget'];

      if ( ! empty( $instance['title'] ) ) {
        echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
      }

      if ( ! empty( $instance['description'] ) ) {
        echo '<p>'. $instance['description'] .'</p>';
      }

      // Widget content output
      echo '
        <div class="roughest-widget-container>
          <form action="javascript:void(0);">
            <input id="val-1-'. $this->id .'" placeholder="'. $instance['val_1'] .'" class="roughest-inputs" type="number" />
            <input id="val-2-'. $this->id .'" placeholder="'. $instance['val_2'] .'" class="roughest-inputs" type="number" />
            
            <br />

            <p>'. $instance['output_title'] .' <strong id="range-'. $this->id .'"></strong></p>
            
            <input id="calculate-'. $this->id .'" type="button" value="calculate" />

            <div id="roughest-notes">
              <p id="validation-'. $this->id .'" class="roughest-display-none roughest-warning-text">'. $instance['error_message'] .'</p>
              <p id="disclaimer-'. $this->id .'" class="roughest-display-none">'. $instance['disclaimer'] .'</p>
            </div>
            
            <div style="visibility:hidden; height: 0">
            <input class="roughest-unique-sqft" type="text" value="'. $this->id .'" />
            <input id="mult-'. $this->id .'" type="number" value="'. $instance['multiplier'] .'" />
              <input id="range-low-'. $this->id .'" type="number" value="'. $instance['range_low'] .'" />
              <input id="range-high-'. $this->id .'" type="number" value="'. $instance['range_high'] .'" />
            </div>
            
          </form>
        </div>
      ';
      
      echo $args['after_widget'];
    }
  
    /**
     * Back-end widget controls
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
      $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Rough Estimate', 'roughest' );

      $description = ! empty( $instance['description'] ) ? $instance['description'] : esc_html__( 'Type in some numbers to get a rough estimate', 'roughest' );

      $val_1 = ! empty( $instance['val_1'] ) ? $instance['val_1'] : esc_html__( 'Length', 'roughest' );

      $val_2 = ! empty( $instance['val_2'] ) ? $instance['val_2'] : esc_html__( 'Width', 'roughest' );

      $output_title = ! empty( $instance['output_title'] ) ? $instance['output_title'] : esc_html__( 'Price Range:', 'roughest' ); 

      $multiplier = ! empty( $instance['multiplier'] ) ? $instance['multiplier'] : esc_html__( 70, 'roughest' );

      $range_low = ! empty( $instance['range_low'] ) ? $instance['range_low'] : esc_html__( 0.6, 'roughest' );

      $range_high = ! empty( $instance['range_high'] ) ? $instance['range_high'] : esc_html__( 1.2, 'roughest' );

      $error_message = ! empty( $instance['error_message'] ) ? $instance['error_message'] : esc_html__( 'Please add two values', 'roughest' );

      $disclaimer = ! empty( $instance['disclaimer'] ) ? $instance['disclaimer'] : esc_html__( '*This is an auto-generated price range for your convenience. Please contact us for a precise quote', 'roughest' );
  
      ?>
      
      
      
      <!-- Title -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
          <?php esc_attr_e( 'Title:', 'roughest' ); ?>
        </label> 

        <input 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
          type="text" 
          value="<?php echo esc_attr( $title ); ?>">
      </p>

      <!-- Description -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">
          <?php esc_attr_e( 'Description:', 'roughest' ); ?>
        </label> 

        <textarea 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" 
          type="text" 
          value=""><?php echo esc_attr( $description ); ?></textarea>
      </p>

      <!-- Value 1 Label -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'val_1' ) ); ?>">
          <?php esc_attr_e( 'First Value Placeholder:', 'roughest' ); ?>
        </label> 

        <input 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'val_1' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'val_1' ) ); ?>" 
          type="text" 
          value="<?php echo esc_attr( $val_1 ); ?>">
      </p>

      <!-- Value 2 Label -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'val_2' ) ); ?>">
          <?php esc_attr_e( 'Second Value Placeholder:', 'roughest' ); ?>
        </label> 

        <input 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'val_2' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'val_2' ) ); ?>" 
          type="text" 
          value="<?php echo esc_attr( $val_2 ); ?>">
      </p>

      <!-- Output Title -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'output_title' ) ); ?>">
          <?php esc_attr_e( 'Output Title:', 'roughest' ); ?>
        </label> 

        <input 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'output_title' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'output_title' ) ); ?>" 
          type="text" 
          value="<?php echo esc_attr( $output_title ); ?>">
      </p>

      <!-- Multiplier -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'multiplier' ) ); ?>">
          <?php esc_attr_e( 'Cost Per Square Foot:', 'roughest' ); ?>
        </label> 

        <input 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'multiplier' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'multiplier' ) ); ?>" 
          type="number" 
          value="<?php echo esc_attr( $multiplier ); ?>">
      </p>

      <!-- Range Low -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'range_low' ) ); ?>">
          <?php esc_attr_e( 'Low Range:', 'roughest' ); ?>
        </label> 

        <select 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'range_low' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'range_low' ) ); ?>">
          <option value="0.9" <?php echo ($range_low == 0.9) ? 'selected' : ''; ?>>
            90%
          </option>
          <option value="0.8" <?php echo ($range_low == 0.8) ? 'selected' : ''; ?>>
            80%
          </option>
          <option value="0.7" <?php echo ($range_low == 0.7) ? 'selected' : ''; ?>>
            70%
          </option>
          <option value="0.6" <?php echo ($range_low == 0.6) ? 'selected' : ''; ?>>
            60%
          </option>
          <option value="0.5" <?php echo ($range_low == 0.5) ? 'selected' : ''; ?>>
            50%
          </option>
          <option value="0.4" <?php echo ($range_low == 0.4) ? 'selected' : ''; ?>>
            40%
          </option>
          <option value="0.3" <?php echo ($range_low == 0.3) ? 'selected' : ''; ?>>
            30%
          </option>
          <option value="0.2" <?php echo ($range_low == 0.2) ? 'selected' : ''; ?>>
            20%
          </option>
        </select>
      </p>

      <!-- Range High -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'range_high' ) ); ?>">
          <?php esc_attr_e( 'High Range:', 'roughest' ); ?>
        </label> 

        <select 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'range_high' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'range_high' ) ); ?>">
          <option value="1.1" <?php echo ($range_high == 1.1) ? 'selected' : ''; ?>>
            110%
          </option>
          <option value="1.2" <?php echo ($range_high == 1.2) ? 'selected' : ''; ?>>
            120%
          </option>
          <option value="1.3" <?php echo ($range_high == 1.3) ? 'selected' : ''; ?>>
            130%
          </option>
          <option value="1.4" <?php echo ($range_high == 1.4) ? 'selected' : ''; ?>>
            140%
          </option>
          <option value="1.5" <?php echo ($range_high == 1.5) ? 'selected' : ''; ?>>
            150%
          </option>
          <option value="1.6" <?php echo ($range_high == 1.6) ? 'selected' : ''; ?>>
            160%
          </option>
          <option value="1.7" <?php echo ($range_high == 1.7) ? 'selected' : ''; ?>>
            170%
          </option>
          <option value="1.8" <?php echo ($range_high == 1.8) ? 'selected' : ''; ?>>
            180%
          </option>
          <option value="1.9" <?php echo ($range_high == 1.9) ? 'selected' : ''; ?>>
            190%
          </option>
        </select>
      </p>

      <!-- Error Message -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'error_message' ) ); ?>">
          <?php esc_attr_e( 'Error Message:', 'roughest' ); ?>
        </label> 

        <input 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'error_message' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'error_message' ) ); ?>" 
          type="text" 
          value="<?php echo esc_attr( $error_message ); ?>">
      </p>

      <!-- Disclaimer -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'disclamer' ) ); ?>">
          <?php esc_attr_e( 'Disclaimer:', 'roughest' ); ?>
        </label> 

        <textarea 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'disclaimer' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'disclaimer' ) ); ?>" 
          type="text" 
          value=""><?php echo esc_attr( $disclaimer ); ?></textarea>
      </p>


      <?php 
    }
  
    /**
     * Sanitize on save
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
      $instance = array();

      $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

      $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';

      $instance['val_1'] = ( ! empty( $new_instance['val_1'] ) ) ? strip_tags( $new_instance['val_1'] ) : '';

      $instance['val_2'] = ( ! empty( $new_instance['val_2'] ) ) ? strip_tags( $new_instance['val_2'] ) : '';

      $instance['output_title'] = ( ! empty( $new_instance['output_title'] ) ) ? strip_tags( $new_instance['output_title'] ) : '';

      $instance['multiplier'] = ( ! empty( $new_instance['multiplier'] ) ) ? strip_tags( $new_instance['multiplier'] ) : '';

      $instance['range_low'] = ( ! empty( $new_instance['range_low'] ) ) ? strip_tags( $new_instance['range_low'] ) : '';

      $instance['range_high'] = ( ! empty( $new_instance['range_high'] ) ) ? strip_tags( $new_instance['range_high'] ) : '';

      $instance['error_message'] = ( ! empty( $new_instance['error_message'] ) ) ? strip_tags( $new_instance['error_message'] ) : '';

      $instance['disclaimer'] = ( ! empty( $new_instance['disclaimer'] ) ) ? strip_tags( $new_instance['disclaimer'] ) : '';

  
      return $instance;
    }
  
  }


/* 



RoughEst - Instant Estimate Calculator / Built By Inland Applications 



*/



 class RoughEst_Run_Widget extends WP_Widget {
  
  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'roughest_widget_run', // Base ID
      esc_html__( 'RoughEst Run Calc', 'roughest' ), // Name
      array( 'description' => esc_html__( 'Calculate a price range based on a single value.', 'roughest' ), ) // Args
    );
  }

  /**
   * Front-end view
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];

    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }

    if ( ! empty( $instance['description'] ) ) {
      echo '<p>'. $instance['description'] .'</p>';
    }

    // Widget content output
    echo '
    <div class="roughest-widget-container>
      <form action="javascript:void(0);">
        <input id="val-1-'. $this->id .'" placeholder="'. $instance['val_1'] .'" class="roughest-inputs" type="number"  />
        
        <br />

        <p>'. $instance['output_title'] .' <strong id="range-'. $this->id .'"></strong></p>
        
        <input id="calculate-'. $this->id .'" type="button" value="calculate" />

        <div id="roughest-notes">
          <p id="validation-'. $this->id .'" class="roughest-display-none roughest-warning-text">'. $instance['error_message'] .'</p>
          <p id="disclaimer-'. $this->id .'" class="roughest-display-none">'. $instance['disclaimer'] .'</p>
        </div>
        
        <div style="visibility:hidden; height: 0">
        <input class="roughest-unique-run" type="text" value="'. $this->id .'" />
        <input id="mult-'. $this->id .'" type="number" value="'. $instance['multiplier'] .'" />
          <input id="range-low-'. $this->id .'" type="number" value="'. $instance['range_low'] .'" />
          <input id="range-high-'. $this->id .'" type="number" value="'. $instance['range_high'] .'" />
        </div>
        
      </form>
    </div>
    ';
    
    echo $args['after_widget'];
  }

  /**
   * Back-end widget controls
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {

    $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Rough Estimate', 'roughest' );

    $description = ! empty( $instance['description'] ) ? $instance['description'] : esc_html__( 'Type in a number to get a rough estimate', 'roughest' );

    $val_1 = ! empty( $instance['val_1'] ) ? $instance['val_1'] : esc_html__( 'Length', 'roughest' );

    $output_title = ! empty( $instance['output_title'] ) ? $instance['output_title'] : esc_html__( 'Price Range:', 'roughest' ); 

    $multiplier = ! empty( $instance['multiplier'] ) ? $instance['multiplier'] : esc_html__( 70, 'roughest' );

    $range_low = ! empty( $instance['range_low'] ) ? $instance['range_low'] : esc_html__( 0.6, 'roughest' );

    $range_high = ! empty( $instance['range_high'] ) ? $instance['range_high'] : esc_html__( 1.2, 'roughest' );

    $error_message = ! empty( $instance['error_message'] ) ? $instance['error_message'] : esc_html__( 'Please add a value', 'roughest' );

    $disclaimer = ! empty( $instance['disclaimer'] ) ? $instance['disclaimer'] : esc_html__( '*This is an auto-generated price range for your convenience. Please contact us for a precise quote', 'roughest' );

    ?>
    
    
    <!-- Title -->
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
        <?php esc_attr_e( 'Title:', 'roughest' ); ?>
      </label> 

      <input 
        class="widefat" 
        id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
        name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
        type="text" 
        value="<?php echo esc_attr( $title ); ?>">
    </p>

    <!-- Description -->
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">
        <?php esc_attr_e( 'Description:', 'roughest' ); ?>
      </label> 

      <textarea 
        class="widefat" 
        id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" 
        name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" 
        type="text" 
        value=""><?php echo esc_attr( $description ); ?></textarea>
    </p>

    <!-- Value 1 Label -->
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'val_1' ) ); ?>">
        <?php esc_attr_e( 'Input Placeholder:', 'roughest' ); ?>
      </label> 

      <input 
        class="widefat" 
        id="<?php echo esc_attr( $this->get_field_id( 'val_1' ) ); ?>" 
        name="<?php echo esc_attr( $this->get_field_name( 'val_1' ) ); ?>" 
        type="text" 
        value="<?php echo esc_attr( $val_1 ); ?>">
    </p>

    <!-- Output Title -->
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'output_title' ) ); ?>">
        <?php esc_attr_e( 'Output Title:', 'roughest' ); ?>
      </label> 

      <input 
        class="widefat" 
        id="<?php echo esc_attr( $this->get_field_id( 'output_title' ) ); ?>" 
        name="<?php echo esc_attr( $this->get_field_name( 'output_title' ) ); ?>" 
        type="text" 
        value="<?php echo esc_attr( $output_title ); ?>">
    </p>

    <!-- Multiplier -->
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'multiplier' ) ); ?>">
        <?php esc_attr_e( 'Cost Per Running Foot:', 'roughest' ); ?>
      </label> 

      <input 
        class="widefat" 
        id="<?php echo esc_attr( $this->get_field_id( 'multiplier' ) ); ?>" 
        name="<?php echo esc_attr( $this->get_field_name( 'multiplier' ) ); ?>" 
        type="number" 
        value="<?php echo esc_attr( $multiplier ); ?>">
    </p>

    <!-- Range Low -->
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'range_low' ) ); ?>">
        <?php esc_attr_e( 'Low Range:', 'roughest' ); ?>
      </label> 

      <select 
        class="widefat" 
        id="<?php echo esc_attr( $this->get_field_id( 'range_low' ) ); ?>" 
        name="<?php echo esc_attr( $this->get_field_name( 'range_low' ) ); ?>">
        <option value="0.9" <?php echo ($range_low == 0.9) ? 'selected' : ''; ?>>
          90%
        </option>
        <option value="0.8" <?php echo ($range_low == 0.8) ? 'selected' : ''; ?>>
          80%
        </option>
        <option value="0.7" <?php echo ($range_low == 0.7) ? 'selected' : ''; ?>>
          70%
        </option>
        <option value="0.6" <?php echo ($range_low == 0.6) ? 'selected' : ''; ?>>
          60%
        </option>
        <option value="0.5" <?php echo ($range_low == 0.5) ? 'selected' : ''; ?>>
          50%
        </option>
        <option value="0.4" <?php echo ($range_low == 0.4) ? 'selected' : ''; ?>>
          40%
        </option>
        <option value="0.3" <?php echo ($range_low == 0.3) ? 'selected' : ''; ?>>
          30%
        </option>
        <option value="0.2" <?php echo ($range_low == 0.2) ? 'selected' : ''; ?>>
          20%
        </option>
      </select>
    </p>

    <!-- Range High -->
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'range_high' ) ); ?>">
        <?php esc_attr_e( 'High Range:', 'roughest' ); ?>
      </label> 

      <select 
        class="widefat" 
        id="<?php echo esc_attr( $this->get_field_id( 'range_high' ) ); ?>" 
        name="<?php echo esc_attr( $this->get_field_name( 'range_high' ) ); ?>">
        <option value="1.1" <?php echo ($range_high == 1.1) ? 'selected' : ''; ?>>
          110%
        </option>
        <option value="1.2" <?php echo ($range_high == 1.2) ? 'selected' : ''; ?>>
          120%
        </option>
        <option value="1.3" <?php echo ($range_high == 1.3) ? 'selected' : ''; ?>>
          130%
        </option>
        <option value="1.4" <?php echo ($range_high == 1.4) ? 'selected' : ''; ?>>
          140%
        </option>
        <option value="1.5" <?php echo ($range_high == 1.5) ? 'selected' : ''; ?>>
          150%
        </option>
        <option value="1.6" <?php echo ($range_high == 1.6) ? 'selected' : ''; ?>>
          160%
        </option>
        <option value="1.7" <?php echo ($range_high == 1.7) ? 'selected' : ''; ?>>
          170%
        </option>
        <option value="1.8" <?php echo ($range_high == 1.8) ? 'selected' : ''; ?>>
          180%
        </option>
        <option value="1.9" <?php echo ($range_high == 1.9) ? 'selected' : ''; ?>>
          190%
        </option>
      </select>
    </p>

    <!-- Error Message -->
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'error_message' ) ); ?>">
        <?php esc_attr_e( 'Error Message:', 'roughest' ); ?>
      </label> 

      <input 
        class="widefat" 
        id="<?php echo esc_attr( $this->get_field_id( 'error_message' ) ); ?>" 
        name="<?php echo esc_attr( $this->get_field_name( 'error_message' ) ); ?>" 
        type="text" 
        value="<?php echo esc_attr( $error_message ); ?>">
    </p>

    <!-- Disclaimer -->
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'disclamer' ) ); ?>">
        <?php esc_attr_e( 'Disclaimer:', 'roughest' ); ?>
      </label> 

      <textarea 
        class="widefat" 
        id="<?php echo esc_attr( $this->get_field_id( 'disclaimer' ) ); ?>" 
        name="<?php echo esc_attr( $this->get_field_name( 'disclaimer' ) ); ?>" 
        type="text" 
        value=""><?php echo esc_attr( $disclaimer ); ?></textarea>
    </p>


    <?php 
  }

  /**
   * Sanitize on save
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();

    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';

    $instance['val_1'] = ( ! empty( $new_instance['val_1'] ) ) ? strip_tags( $new_instance['val_1'] ) : '';

    $instance['output_title'] = ( ! empty( $new_instance['output_title'] ) ) ? strip_tags( $new_instance['output_title'] ) : '';

    $instance['multiplier'] = ( ! empty( $new_instance['multiplier'] ) ) ? strip_tags( $new_instance['multiplier'] ) : '';

    $instance['range_low'] = ( ! empty( $new_instance['range_low'] ) ) ? strip_tags( $new_instance['range_low'] ) : '';

    $instance['range_high'] = ( ! empty( $new_instance['range_high'] ) ) ? strip_tags( $new_instance['range_high'] ) : '';

    $instance['error_message'] = ( ! empty( $new_instance['error_message'] ) ) ? strip_tags( $new_instance['error_message'] ) : '';

    $instance['disclaimer'] = ( ! empty( $new_instance['disclaimer'] ) ) ? strip_tags( $new_instance['disclaimer'] ) : '';


    return $instance;
  }

} // later