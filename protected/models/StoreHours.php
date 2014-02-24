<?php

/**
 * This is the model class for table "store_hours".
 *
 * The followings are the available columns in table 'store_hours':
 * @property integer $id
 * @property integer $branch_id
 * @property integer $day_of_week
 * @property string $open_time
 * @property string $close_time
 *
 * The followings are the available model relations:
 * @property Branches $branch
 */
class StoreHours extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'store_hours';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch_id, day_of_week, open_time, close_time', 'required'),
			array('branch_id, day_of_week', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, branch_id, day_of_week, open_time, close_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'branch' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'branch_id' => 'Branch',
			'day_of_week' => 'Day Of Week',
			'open_time' => 'Open Time',
			'close_time' => 'Close Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('day_of_week',$this->day_of_week);
		$criteria->compare('open_time',$this->open_time,true);
		$criteria->compare('close_time',$this->close_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StoreHours the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
