update industry.nadbavka_absolutnaya set data='15.01.2014' where data between '01.01.2014' and '31.01.2014';
insert into industry.nadbavka_absolutnaya(value,values_set_id,data,tariff_value)
select --
 round(value/3*2),values_set_id,'01.01.2014',16.00
from industry.nadbavka_absolutnaya  where data='15.01.2014';
insert into industry.nadbavka_absolutnaya(value,values_set_id,data,tariff_value)
select --
 value-round(value/3*2),values_set_id,'30.01.2014',16.54
from industry.nadbavka_absolutnaya  where data='15.01.2014';
delete from industry.nadbavka_absolutnaya where data='15.01.2014';

update industry.sovm_absolutnyy set data='15.01.2014' where data between '01.01.2014' and '31.01.2014';
insert into industry.sovm_absolutnyy (parent_firm_id,value,data,values_set_id,tariff_value)
select --
 parent_firm_id,round(value/3*2),'01.01.2014',values_set_id,16.00
from industry.sovm_absolutnyy  where data='15.01.2014';
insert into industry.sovm_absolutnyy(parent_firm_id,value,data,values_set_id,tariff_value)
select --
 parent_firm_id,value-round(value/3*2),'30.01.2014',values_set_id,16.54
from industry.sovm_absolutnyy  where data='15.01.2014';
delete from industry.sovm_absolutnyy where data='15.01.2014';
