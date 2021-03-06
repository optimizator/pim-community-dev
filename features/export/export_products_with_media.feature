@javascript
Feature: Export products with media
  In order to re-use the images and documents I have set on my products
  As Julia
  I need to be able to export them along with the products

  Scenario: Successfully export products with media
    Given a "footwear" catalog configuration
    And the following products:
      | sku      | family   | categories        |
      | SNKRS-1B | sneakers | summer_collection |
      | SNKRS-1R | sneakers | summer_collection |
      | SNKRS-1C | sneakers | summer_collection |
    And the following product values:
      | product  | attribute | value          | locale |
      | SNKRS-1B | Name      | Model 1        | en_US  |
      | SNKRS-1B | Price     | 50 EUR, 70 USD |        |
      | SNKRS-1B | Size      | 45             |        |
      | SNKRS-1B | Color     | black          |        |
      | SNKRS-1B | side_view |                |        |
      | SNKRS-1R | Name      | Model 1        | en_US  |
      | SNKRS-1R | Price     | 50 EUR, 70 USD |        |
      | SNKRS-1R | Size      | 45             |        |
      | SNKRS-1R | Color     | red            |        |
      | SNKRS-1R | side_view | SNKRS-1R.png   |        |
      | SNKRS-1C | Name      | Model 1        | en_US  |
      | SNKRS-1C | Price     | 55 EUR, 75 USD |        |
      | SNKRS-1C | Size      | 45             |        |
      | SNKRS-1C | Color     | charcoal       |        |
      | SNKRS-1C | side_view | SNKRS-1C-s.png |        |
      | SNKRS-1C | top_view  | SNKRS-1C-t.png |        |
    And I launched the completeness calculator
    And I am logged in as "Julia"
    And I am on the "footwear_product_export" export job page
    When I launch the export job
    And I wait for the job to finish
    Then exported file of "footwear_product_export" should contain:
    """
    sku;family;groups;categories;color;description-en_US-mobile;lace_color;manufacturer;name-en_US;price;rating;side_view;size;top_view;weather_conditions;enabled
    SNKRS-1B;sneakers;;summer_collection;black;;;;"Model 1";"50.00 EUR,70.00 USD";;;45;;;1
    SNKRS-1R;sneakers;;summer_collection;red;;;;"Model 1";"50.00 EUR,70.00 USD";;files/SNKRS-1R/side_view/SNKRS-1R.png;45;;;1
    SNKRS-1C;sneakers;;summer_collection;charcoal;;;;"Model 1";"55.00 EUR,75.00 USD";;files/SNKRS-1C/side_view/SNKRS-1C-s.png;45;files/SNKRS-1C/top_view/SNKRS-1C-t.png;;1

    """
    And export directory of "footwear_product_export" should contain the following media:
      | files/SNKRS-1R/side_view/SNKRS-1R.png   |
      | files/SNKRS-1C/side_view/SNKRS-1C-s.png |
      | files/SNKRS-1C/top_view/SNKRS-1C-t.png  |
