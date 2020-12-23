package com.example.groupapplication;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.FragmentPagerAdapter;
import androidx.viewpager.widget.ViewPager;

import com.google.android.material.navigation.NavigationView;
import com.google.android.material.tabs.TabItem;
import com.google.android.material.tabs.TabLayout;

public class MainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    DrawerLayout drawerLayout;
    ActionBarDrawerToggle toggle;
    NavigationView navigationView;
    ViewPager pager;
    TabLayout tabLayout;
    TabItem tabGroceries, tabInstruments, tabFashion;
    PagerAdapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        //check to see if the user is logged in first
        setContentView(R.layout.activity_main);
        Toolbar toolbar = findViewById(R.id.toolbar);
//        toolbar.setTitle("placeholder");
//        toolbar.setTitleTextColor(Color.GREEN);
        toolbar.setTitle("");  // this is done to remove PROJECTNAME in the toolbar at the top
        setSupportActionBar(toolbar);

        pager = findViewById(R.id.viewPager);
        tabLayout = findViewById(R.id.tabLayout);
        tabGroceries = findViewById(R.id.tabGroceries);
        tabInstruments = findViewById(R.id.tabInstruments);
        tabFashion = findViewById(R.id.tabFashion);

        drawerLayout = findViewById(R.id.drawer);
        navigationView = findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        toggle = new ActionBarDrawerToggle(this, drawerLayout, toolbar, R.string.open, R.string.close);
        drawerLayout.addDrawerListener(toggle);
        toggle.setDrawerIndicatorEnabled(true);
        toggle.syncState();

        adapter = new PagerAdapter(getSupportFragmentManager(), FragmentPagerAdapter.BEHAVIOR_RESUME_ONLY_CURRENT_FRAGMENT, tabLayout.getTabCount());
        pager.setAdapter(adapter);

        tabLayout.addOnTabSelectedListener(new TabLayout.OnTabSelectedListener() {
            @Override
            public void onTabSelected(TabLayout.Tab tab) {
                pager.setCurrentItem(tab.getPosition());
            }

            @Override
            public void onTabUnselected(TabLayout.Tab tab) {

            }

            @Override
            public void onTabReselected(TabLayout.Tab tab) {

            }
        });

        pager.addOnPageChangeListener(new TabLayout.TabLayoutOnPageChangeListener(tabLayout));

    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        drawerLayout.closeDrawer(GravityCompat.START);

//        if (item.getItemId() == R.id.menu_home) {
//            setContentView(R.layout.activity_main);
//            Intent newIntent = new Intent(this, MainActivity.class);
//            startActivity(newIntent);
//        }
        if (item.getItemId() == R.id.menu_login_or_register) {
            Intent newIntent = new Intent(this, ActivityLogin.class);
            startActivity(newIntent);
        }
        else if (item.getItemId() == R.id.menu_logout) {
            Toast.makeText(this, "{Username} logged out", Toast.LENGTH_SHORT).show();
            Intent newIntent = new Intent(this, ActivityLogin.class);
            startActivity(newIntent);
        }
//        else if (item.getItemId() == R.id.menu_register) {
//            Intent newIntent = new Intent(this, ActivityRegister.class);
//            startActivity(newIntent);
//        }
       else if (item.getItemId() == R.id.menu_reviews) {
            Intent newIntent = new Intent(this, ActivityReviews.class);
            startActivity(newIntent);
        }
       else if (item.getItemId() == R.id.menu_specifications) {
            Intent newIntent = new Intent(this, ActivitySpecifications.class);
            startActivity(newIntent);
        }
       else if (item.getItemId() == R.id.menu_history) {
            Intent newIntent = new Intent(this, ActivityHistory.class);
            startActivity(newIntent);
        }
        else if (item.getItemId() == R.id.menu_support) {
            Intent newIntent = new Intent(this, ActivitySupport.class);
            startActivity(newIntent);
        }
        return false;
    }
}